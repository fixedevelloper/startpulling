<?php


namespace App\Http\Controllers;


use App\Models\Bank;
use App\Models\Country;
use App\Models\Sim;
use App\Models\Transaction;
use App\Models\UssdRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class UssdRequestController extends Controller
{

    public function index(Request $request){
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $lists = Transaction::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $lists = new Transaction();
        }
        $lists = $lists->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('home', [
            'items'=>$lists
        ]);
    }
    public function countries(Request $request){
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $lists = Country::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $lists = new Country();
        }
        $lists = $lists->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('countries', [
            'items'=>$lists
        ]);
    }
    public function create(Request $request){
        if ($request->method()=='POST'){
            logger($request->all());
            $tras=new Transaction();
            $tras->country_id=$request->country;
            $tras->customer=$request->name;
            $tras->phone=$request->phone;
            $tras->amount=$request->amount;
            $tras->bank_id=$request->bank_id;
            $tras->reference=uniqid('trans_');
            $tras->save();
            return redirect()->route('home');
        }
        return view('create', [
            'items'=>Country::all()
        ]);
    }
    public function store(){

    }
    function getCinetPayBalance()
    {
        $token = $this->getCinetPayToken(); // fonction définie précédemment

        $response = Http::get('https://client.cinetpay.com/v1/transfer/check/balance', [
            'token' => $token,
            'lang' => 'fr'
        ]);
        return view('balance', [
            'items'=>$response->json()
        ]);
    }
    public function markDone(){

    }
    public function getSimAjax(Request $request)
    {

        $gateways = Bank::query()->where(['country_id'=>$request->get('country_id'),'is_mobil'=>true])->get();

        return response()->json(['data' => $gateways, 'status' => true]);
    }
    function getCinetPayToken()
    {
        $response = Http::asForm()->post('https://client.cinetpay.com/v1/auth/login', [
            'apikey' => env('CINETPAY_APIKEY'),
            'password' => env('CINETPAY_PASSWORD')
        ]);

        return $response->json('data.token') ?? abort(401, 'Token CinetPay invalide');
    }
}
