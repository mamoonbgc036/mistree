<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register()
    {
        return view("sessions.register");
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'phone' => ['required', 'numeric'],
            'type' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::create($credentials);
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Registerd Successfully');
    }
}
