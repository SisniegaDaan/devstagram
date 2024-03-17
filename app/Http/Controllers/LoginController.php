<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view("auth/login");
    }

    public function post(Request $request)
    {
        auth()->attempt($request->only("email","password"));
        return redirect()->route('posts.index');
    }
}
