<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UssdRequest;

class UssdController extends Controller
{
    public function sendUssd(Request $req) {
        $req->validate(['device_id'=>'required','ussd_code'=>'required']);
        UssdRequest::create($req->only('device_id','ussd_code'));
        return response()->json(['message'=>'Command stored'],201);
    }

    public function checkUssd($device_id) {
        $cmd = UssdRequest::where('device_id',$device_id)->where('status','pending')->first();
        if ($cmd) {
            $cmd->update(['status'=>'sent']);
            return response()->json(['id'=>$cmd->id,'ussd_code'=>$cmd->ussd_code]);
        }
        return response()->json(['ussd_code'=>null]);
    }

    public function reportUssd(Request $req) {
        $req->validate(['id'=>'required','response'=>'required']);
        if ($cmd = UssdRequest::find($req->id)) {
            $cmd->update(['status'=>'executed','response'=>$req->response]);
        }
        return response()->json(['message'=>'Response saved']);
    }
    public function getUssdRequestForUser($userId)
{
    // Exemple : récupérer la requête USSD et la position SIM associée pour l'utilisateur
    $request = UssdRequest::where('user_id', $userId)
        ->where('processed', false)
        ->first();

    if (!$request) {
        return response()->json(['message' => 'No USSD request'], 404);
    }

    return response()->json([
        'ussd_code' => $request->code,
        'sim_position' => $request->sim_position, // ex: 0 pour SIM1, 1 pour SIM2
        'request_id' => $request->id,
    ]);
}

}
