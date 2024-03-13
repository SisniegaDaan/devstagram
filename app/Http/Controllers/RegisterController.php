<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> ['required', 'max:30'],
            'username'=> ['required', 'unique:users', 'min:3', 'max:20'],
            'email'=> ['required', 'email', 'unique:users', 'min:3', 'max:20'],
            'password'=> ['required', 'confirmed'],
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password
        ]);

    }
}
