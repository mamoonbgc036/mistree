<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Storage;

class RegisterController extends Controller
{
    public function register()
    {
        return view("sessions.register");
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'phone' => ['required', 'numeric', 'unique:users,phone'],
            // 'type' => ['required'],
            'password' => ['required'],
        ]);

        if ($request->hasFile('image')) {
            $path = Storage::put('user', $request->image);
            $credentials['image'] = $path;
        }

        $user = User::create($credentials);
        Auth::login($user);
        return redirect()->route('service.create')->with('success', 'Registerd Successfully');
    }
}
