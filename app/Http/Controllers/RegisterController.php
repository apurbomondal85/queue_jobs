<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Models\User;
use App\Mail\TestMail;
use App\Mail\AdminMail;
use Illuminate\Http\Request;
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
}
