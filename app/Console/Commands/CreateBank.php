<?php

namespace App\Console\Commands;

use App\Models\Bank;
use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CreateBank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-bank';

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
        $countries=Country::all();
        foreach ($countries as $country){
            $secretKey = config('app.FLUTTERWAVE_SECRET_KEY');
            $country_code = $country->iso;
            logger($country);
            $response = Http::withToken($secretKey)->withOptions([
                'verify' => false,
            ])->get("https://api.flutterwave.com/v3/banks/$country_code");
            logger($response);
            if ($response->successful()) {
                $banks = $response->json()['data'];
                foreach ($banks as $bank){
                    $bk=new Bank();
                    $bk->name=$bank['name'];
                    $bk->code=$bank['code'];
                    $bk->gateway='flutterwave';
                    $bk->country_id=$country->id;
                    $bk->save();
                }
            }
        }
    }
    public function cinetPay(){

    }

}
