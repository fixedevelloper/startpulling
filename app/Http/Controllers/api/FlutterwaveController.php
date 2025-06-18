<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlutterwaveController extends Controller
{
    public function sendMoney(Request $request)
    {
        $response = Http::withToken(env('FLUTTERWAVE_SECRET_KEY'))->post('https://api.flutterwave.com/v3/transfers', [
            "account_bank" => $request->bank_code, // e.g. "FBN"
            "account_number" => $request->account_number,
            "amount" => $request->amount,
            "currency" => "XOF", // pour l’Afrique de l’Ouest
            "beneficiary_name" => $request->beneficiary_name,
            "narration" => $request->narration ?? "Transfert via Flutterwave",
            "reference" => uniqid('trans_'),
            "callback_url" => "https://creativsoftcm/callback"
        ]);

        return response()->json($response->json(), $response->status());
    }
    public function getBanks()
    {
        $secretKey = env('FLUTTERWAVE_SECRET_KEY');
        $currency = 'BF'; // Pour l’Afrique de l’Ouest

        $response = Http::withToken($secretKey)
            ->get("https://api.flutterwave.com/v3/banks/$currency");

        if ($response->successful()) {
            $banks = $response->json()['data'];
            return view('banks.index', compact('banks'));
        }
        logger($response);
        return back()->withErrors(['error' => 'Impossible de récupérer la liste des banques.']);
    }
}
