<?php


namespace App\Http\helpers;


use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class CinetpayService
{

    function getCinetPayToken()
    {
        $response = Http::asForm()->post('https://client.cinetpay.com/v1/auth/login', [
            'apikey' => env('CINETPAY_APIKEY'),
            'password' => env('CINETPAY_PASSWORD')
        ]);

        return $response->json('data.token') ?? abort(401, 'Token CinetPay invalide');
    }
    public function createTransaction(Transaction $transaction){
        $token = $this->getCinetPayToken();

        // 1.1 Ajouter le contact (bénéficiaire)
        $contactResponse = Http::asForm()->post('https://client.cinetpay.com/v1/transfer/contact', [
            'token' => $token,
            'lang' => 'fr',
            'data' => json_encode([[
                'prefix' => $transaction->country->code_phone,
                'phone' => $transaction->phone,
                'name' => $transaction->customer,
                'surname' => $transaction->customer,
                'email' => 'no@email.com'
            ]])
        ]);

        // 1.2 Lancer le transfert
        $transferResponse = Http::asForm()->post('https://client.cinetpay.com/v1/transfer/money/send/contact', [
            'token' => $token,
            'lang' => 'fr',
            'data' => json_encode([[
                'prefix' => '237',
                'phone' => $transaction->phone,
                'amount' => $transaction->amount,
                'client_transaction_id' => $transaction->reference,
                'notify_url' => route('cinetpay.notify'),
               // 'payment_method' => $request->method ?? 'WAVECM'
            ]])
        ]);

        return $transferResponse->json();
    }
}
