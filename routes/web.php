<?php

use App\Http\Controllers\UssdRequestController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UssdRequestController::class, 'index'])->name('home');
Route::match(['POST','GET'],'/create', [UssdRequestController::class, 'create'])->name('create');
Route::match(['POST','GET'],'/getsim', [UssdRequestController::class, 'getSimAjax'])->name('getsim');
Route::post('/ussd', [UssdRequestController::class, 'store'])->name('store');
Route::post('/ussd/{id}/mark-done', [UssdRequestController::class, 'markDone']);
