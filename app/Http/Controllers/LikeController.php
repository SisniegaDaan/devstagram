<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // No hay validación porque no se llena ningún formulario
        // Se crea el registro
        $post->likes()->create([
            'user_id'=> $request->user()->id
        ]);

        return back();
    }

    public function destroy(Request $request, Post $post)
    {
        // Eliminar likes accediendo por el usuario
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
