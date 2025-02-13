@extends('layouts.app')

@section('titulo')
Post de {{ $post->user->username}}
@endsection

@section('contenido')
<div class="container mx-auto flex flex-col sm:flex-row">

    <div class="sm:w-1/2 p-5">
        <div class="flex items-center gap-4 mb-2">
            <img 
                class="size-8 rounded-full"
                src="{{ $post->user->imagen ? asset('perfiles') . '/' . $post->user->imagen : asset('img/user-profile.jpg') }}" 
            />
            
            <div>
                <a class="font-bold" href="{{ route('posts.index', ['user'=>$post->user]) }}">{{ $post->user->username
                    }}</a>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
            </div>


        </div>
        <img src="{{ asset('uploads') . "/" . $post->imagen }}" alt="Post - {{ $post->titulo }}">
        <div class="flex justify-between p-3">

            <div class="flex justify-center items-center">
                @auth
                <livewire:like-post :post="$post" />
                @endauth
            </div>

            <!-- Acciones de autor -->
            @auth()
            @if ($post->user_id === auth()->user()->id)
            <form method="POST" action="{{ route('posts.destroy', ['post'=>$post]) }}">
                @csrf
                @method('delete')
                <input type="submit" value="Eliminar publicación"
                    class="p-2 bg-red-500 text-white rounded-md shadow-md">
            </form>
            @endif
            @endauth

        </div>
    </div>

    <div class="flex flex-col sm:w-1/2 p-5">
        <h1 class="font-black text-left">{{ $post->titulo }}</h1>
        <p class="mt-4 text-left">{{ $post->descripcion }}</p>

        <div class="flex flex-col justify-end flex-grow shadow bg-white p-5 mb-5 mt-5 h-full">
            <!-- Lista de comentarios -->
            @if ($post->comentarios->count() > 0)
            <div class="flex flex-col flex-grow justify-start gap-3 mb-8 mt-0">
                @foreach ($post->comentarios as $comentario)
                <!-- Comentario -->
                <div class="flex items-center gap-4">
                    <img class="size-8 rounded-full"
                        src="{{ $comentario->user->imagen ? asset('perfiles') . '/' . $comentario->user->imagen : asset('img/user-profile.jpg') }}" />
                    <div>
                        <a href="{{ route('posts.index', ['user'=>$comentario->user]) }}"
                            class="font-bold inline">{{$comentario->user->username}}</a>
                        <span class="text-gray-500">{{$comentario->created_at->diffForHumans()}}</span></p>
                        <p>{{$comentario->comentario}}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else <!-- Si no hay comentarios -->
            <div class="flex flex-col justify-center flex-grow mb-8 mt-5">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-12 h-12 text-gray-500 mx-auto">
                        <path fill-rule="evenodd"
                            d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97-1.94.284-3.916.455-5.922.505a.39.39 0 0 0-.266.112L8.78 21.53A.75.75 0 0 1 7.5 21v-3.955a48.842 48.842 0 0 1-2.652-.316c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97Z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-gray-500 text-center font-bold"> No hay comentarios aún. <br> Sé el primero en
                        comentar :)</p>
                </div>
            </div>
            @endif

            @auth
            <form action="{{ route('comentarios.store', ['user'=>$post->user, 'post'=>$post]) }}" method="post">
                @csrf
                <div>
                    <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                        Añade un comentario
                    </label>
                    <textarea id="comentario" name="comentario" rows="3"
                        placeholder="Di algo interesante sobre esta publicación..."
                        class="border p-3 w-full rounded-lg"></textarea>
                </div>
                <input type="submit" value="Publicar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                        uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>

            @endauth

            @guest
            <p class="text-gray-500 text-center font-bold">
                Para comentar necesitas <a href="{{ route('login') }}"><span class="underline">iniciar
                        sesión</span></a>,
                o bien, <a href="{{ route('register') }}"><span class="underline">crear una cuenta</span></a>.
            </p>
            @endguest

        </div>
    </div>

</div>
@endsection