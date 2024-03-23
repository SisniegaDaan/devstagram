<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view("auth/login");
    }

    public function store(Request $request)
    {

        // Validación de formulario
        $this->validate($request, [
            "email" => ["required", "email"],
            "password" => ["required"]
        ]);

        dd($request);

        // Intendo de validación
        // Si no puede autenticarse
        if(!auth()->attempt($request->only('email', 'password')))
        {
            return back()->with('error','Credenciales incorrectas. Revisa tu email y contraseña.');
        };

        return redirect()->route('posts.index');
    }
}
