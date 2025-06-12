<?php


namespace App\Http\Controllers;


use App\Models\Country;
use App\Models\Sim;
use App\Models\UssdRequest;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UssdRequestController extends Controller
{

    public function index(){

        return view('home', [
            'items'=>UssdRequest::all()
        ]);
    }
    public function create(Request $request){
        if ($request->method()=='POST'){
            logger($request->all());
            $sim=Sim::query()->find($request->sim);
            $tras=new UssdRequest();
            $tras->country_id=$request->country;
            $tras->customer=$request->name;
            $tras->phone=$request->phone;
            $tras->amount=$request->amount;
            $tras->type_transaction=$request->type_transaction;
            $tras->sim_position=$sim->position;
            $tras->ussd_code=$sim->code_court;
            $tras->save();
            return redirect()->route('home');
        }
        return view('create', [
            'items'=>Country::all()
        ]);
    }
    public function store(){

    }
    public function markDone(){

    }
    public function getSimAjax(Request $request)
    {

        $gateways = Sim::query()->where(['country_id'=>$request->get('country_id')])->get();

        return response()->json(['data' => $gateways, 'status' => true]);
    }
}
