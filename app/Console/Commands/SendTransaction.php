<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendTransaction extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $transactions=Transaction::query()->where('status','pending')->get();
 /*       foreach ($transactions as $transaction){
            $response = Http::withToken(env('FLUTTERWAVE_SECRET_KEY'))->withOptions([
                'verify' => false,
            ])->post('https://api.flutterwave.com/v3/transfers', [
                "account_bank" => $transaction->bank->code, // e.g. "FBN"
                "account_number" => $transaction->phone,
                "amount" => $transaction->amount,
                "currency" => $transaction->country->currency,
                "beneficiary_name" => $transaction->customer,
                "narration" => $transaction->narration ?? "Transfert via Flutterwave",
                "reference" => $transaction->reference,
                "callback_url" => "https://creativsoftcm/callback"
            ]);
            logger($response);
            if ($response->successful()) {
               $json=$response->json();
              if ($json['status'] =='success'){
                  $transaction->status='sent';
                  $transaction->save();
              }
            }
        }*/
        foreach ($transactions as $transaction){
            $res=$this->createTransaction($transaction);
            logger($res);
            if ($res['code'] ==0){
                $transaction->status='sent';
                $transaction->response=$res['message'];
                $transaction->transaction_id=$res['data']['transaction_id'];
            }else{
                $transaction->status='executed';
                $transaction->response=$res['description'];
            }

            $transaction->save();
        }

    }
    function getCinetPayToken()
    {
        $response = Http::asForm()->post('https://client.cinetpay.com/v1/auth/login', [
            'apikey' => config('app.CINETPAY_APIKEY'),
            'password' => config('app.CINETPAY_PASSWORD')
        ]);

        return $response->json('data.token') ?? abort(401, 'Token CinetPay invalide');
    }
    public function createTransaction(Transaction $transaction){
        $token = $this->getCinetPayToken();
        logger($token);
        // 1.1 Ajouter le contact (bénéficiaire)
        $contactResponse = Http::asForm()->post("https://client.cinetpay.com/v1/transfer/contact?token=$token&lang=fr", [
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
        logger($contactResponse);
        // 1.2 Lancer le transfert
        $transferResponse = Http::asForm()->post("https://client.cinetpay.com/v1/transfer/money/send/contact?token=$token&lang=fr", [
            'token' => $token,
            'lang' => 'fr',
            'data' => json_encode([[
                'prefix' => $transaction->country->code_phone,
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
