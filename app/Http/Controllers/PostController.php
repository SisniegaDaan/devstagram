<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except(['show', 'index']);
    }
    
    public function index(User $user)
    {
        // Realizando cconsulta de posts del usuario para
        // mostrarlos en la vista dashboard.
        $userPosts = Post::where('user_id', $user->id)->paginate(6);
        
        return view('dashborad', [
            'user' => $user,
            'posts' => $userPosts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request){
        
        // Validación del formulario de carga de nuevos posts
        $this->validate($request, 
        [
            'titulo' => ['required', 'max:30'], 
            'descripcion' => ['required', 'max:220'],
            'imagen' => ['required']
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', 
        [
            'post'=>$post
        ]);
    }

    public function destroy(Post $post)
    {
        // Es necesario proteger el boton de eliminar para que solo lo
        // pueda ver el autor de la publicación... Se procede a ir a la vista donde se mostrará.
        
        $this->authorize('delete', $post);
        $post->delete();
        
        $imagenPath = public_path('uploads/' . $post->imagen);
        
        // Comprobar existencia del path
        if (File::exists(($imagenPath)))
        {
            unlink($imagenPath);
        }
        
        return redirect()->route('posts.index', auth()->user());
    }
}
