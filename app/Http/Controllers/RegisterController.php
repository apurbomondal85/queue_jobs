<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\TestMail;
use App\Mail\AdminMail;
use App\Jobs\SendOtpJob;
use App\Jobs\SendMailJob;
use App\Jobs\FailedMailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'email' =>'required|email|unique:users',
                'password' => 'required',
            ]);
    
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
    
            dispatch(new SendMailJob($user));
    
            return back()->with('success', 'Successfully registered');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function sendOtp(Request $request)
    {
        dispatch(new SendOtpJob())->onQueue('high');

        return back()->with('success', 'OTP sent successfully');
    }

    public function moneyTransfer()
    {
        return view('money_transfer');
    }

    public function sendMoneyTransfer(Request $request)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        dispatch(new FailedMailJob($request->amount));

        return back()->with('success', 'Money transfer successful');
    }

}
