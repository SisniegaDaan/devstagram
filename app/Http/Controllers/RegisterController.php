<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Convirtiendo el valor que ingresa el usuario a un valor
        // apto para ser usado en url
        $request->request->add(['username' => Str::slug($request->username)]);
    
        // Validación de campos
        $this->validate($request, [
            'name'=> ['required', 'max:30'],
            'username'=> ['required', 'unique:users', 'min:3', 'max:20'],
            'email'=> ['required', 'email', 'unique:users', 'min:3', 'max:20'],
            'password'=> ['required', 'confirmed']
        ]);
        
        // Creación del usuario post a la conversión y validación de datos
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password
        ]);

    }
}
