<?php

use App\Http\Controllers\UssdRequestController;
use App\Http\Controllers\api\FlutterwaveController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UssdRequestController::class, 'index'])->name('home');
Route::match(['POST','GET'],'/create', [UssdRequestController::class, 'create'])->name('create');
Route::match(['POST','GET'],'/countries', [UssdRequestController::class, 'countries'])->name('countries');
Route::match(['POST','GET'],'/getsim', [UssdRequestController::class, 'getSimAjax'])->name('getsim');
Route::match(['POST','GET'],'/balance', [UssdRequestController::class, 'getCinetPayBalance'])->name('balance');
Route::post('/ussd', [UssdRequestController::class, 'store'])->name('store');
Route::post('/ussd/{id}/mark-done', [UssdRequestController::class, 'markDone']);
Route::get('/flutterwave/banks', [FlutterwaveController::class, 'getBanks']);
