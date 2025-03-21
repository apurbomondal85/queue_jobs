<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'registerForm']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/send-otp', [RegisterController::class, 'sendOtp'])->name('sendOtp');

Route::get('/money-transfer', [RegisterController::class, 'moneyTransfer'])->name('moneyTransfer');
Route::post('/money-transfer-store', [RegisterController::class, 'sendMoneyTransfer'])->name('moneyTransferStore');