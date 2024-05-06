<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comentario;

class ComentarioController extends Controller
{
    public function store(request $request, User $user, Post $post)
    {
        // Validación de comentario
        $this->validate($request, 
        [
            'comentario' => ['required', 'max:550']
        ]);

        // Creación de comentario
        Comentario::create([
            "comentario" => $request->comentario,
            "user_id" => auth()->user()->id,
            "post_id" => $post->id
        ]);


        // Devolución de vista
        return back()->with('mensaje', 'Comentario realizado exitosamente');
    }
}
