<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function login()
    {
        return view("sessions.login");
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'phone' => ['required', 'numeric'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Credentials does\'t matched !');
        }

        return redirect()->back()->with('login_error', 'Credentials does\'t matched');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('login')->with('success', 'Logout Successful');
    }
}
