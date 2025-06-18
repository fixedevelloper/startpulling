<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UssdRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class USSDController extends Controller
{

    public function cinetPayWebhook(Request $request){

        logger(  $request->all());
        return response()->json(['status' => 'received']);
    }

    public function getRequest()
    {
        $trans=UssdRequest::query()->firstWhere(['status'=>'pending']);
        logger($trans);
        return response()->json([
            'code' => $trans->ussd_code,
            'sim_slot' => $trans->sim_position,
            'transaction_id' => $trans->id,
        ]);
    }
    public function getLastTransaction()
    {
        $tran=UssdRequest::query()->firstWhere(['status'=>'pending']);
        if (is_null($tran)){
            return response()->json([

            ]);
        }else{
            return response()->json([
                'id'=>$tran->id,
                'phone'=>$tran->phone,
                'type_transaction'=>$tran->type_transaction,
                'amount'=>$tran->amount,
                'status'=>$tran->status,
                'date'=>Carbon::parse($tran->created_at)->format('Y-m-d'),
            ]);
        }

    }
    public function getLastTransactions()
    {
        $trans=UssdRequest::query()->oldest('created_at')->get();
        $arrays=[];
        foreach ($trans as $tran){
            $arrays[]=[
                'id'=>$tran->id,
                'phone'=>$tran->phone,
                'type_transaction'=>$tran->type_transaction,
                'amount'=>$tran->amount,
                'status'=>$tran->status,
                'date'=>Carbon::parse($tran->created_at)->format('Y-m-d'),
            ];
        }
        return response()->json($arrays);
    }
    public function saveResponse(Request $request)
    {
        \Log::info('USSD Response:', $request->all());
        $trans=UssdRequest::query()->find($request->transaction_id);
        if ($request->status){
            $trans->status=$request->status;
        }
        $trans->response=$request->response;
        $trans->save();
        return response()->json(['status' => 'success']);
    }
}
