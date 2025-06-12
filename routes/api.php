<?php

use App\Http\Controllers\api\USSDController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/send-ussd', [UssdController::class, 'sendUssd']);
#Route::get('/check-ussd/{device_id}', [UssdController::class, 'checkUssd']);
Route::post('/report-ussd', [USSDController::class, 'saveResponse']);
Route::get('/check-ussd', [USSDController::class, 'getRequest']);
Route::get('/transactions', [USSDController::class, 'getLastTransactions']);
Route::get('/transaction', [USSDController::class, 'getLastTransaction']);
