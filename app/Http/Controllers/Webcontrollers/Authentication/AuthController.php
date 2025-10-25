<?php

namespace App\Http\Controllers\Webcontrollers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'بيانات تسجيل الدخول غير صحيحة.',
        ])->withInput($request->only('email'));

    }
}
