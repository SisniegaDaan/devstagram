@extends('layouts.app')

@section('titulo')
Perfil
@endsection

@section('contenido')
<div class="flex justify-center">
    <div class="flex flex-col justify-center w-8/12 lg:flex-row">

        <!-- Imagen de perfil -->
        <div class="w-full flex justify-center lg:w-6/12">
            <img class="w-6/12" src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/user-profile.jpg') }}"/>
        </div>

        <!-- Info del perfil -->
        <div class="flex flex-col justify-center w-full lg:w-6/12 text-center">
            <div class="flex justify-center items-center">
                <p class="text-gray-700 text-2xl font-bold p-3">{{ $user->username }}</p>

                <!-- Debes de estar autenticado para realizar estas acciones -->
                @auth
                    <!-- Si el usuario del perfil es el usuario autenticado, mostrar "editar" -->
                    @if ($user->id === auth()->user()->id)
                        <a 
                            class="bg-gray-500 hover:bg-gray-400 text-center"
                            href="{{ route('perfil.index', ['user'=>$user]) }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                            </svg>
                        </a>

                    <!-- Si el usuario del perfil no es el usuario autenticado -->
                    @else
                        <!-- Si el usuario autenticado no sigue al perfil, mostrar "Seguir" -->
                        @if (!$user->isFollowedBy( auth()->user() ))
                            <form class="flex items-center" method="POST" action="{{ route('users.follow', $user) }}">
                                @csrf
                                <input
                                    type="submit"
                                    value="Seguir"
                                    class="bg-sky-500 hover:bg-sky-600 transition-colors cursor-pointer 
                                    uppercase font-bold text-xs px-3 py-1 text-white rounded-lg"
                                />
                            </form>
                        
                        <!-- Si el usuario autenticado ya sigue al perfil, mostrar "Dejar de seguir" -->
                        @else
                            <form class="flex items-center" method="POST" action="{{ route('users.unfollow', $user) }}">
                                @csrf
                                @method('DELETE')
                                <input
                                    type="submit"
                                    value="Dejar de seguir"
                                    class="bg-red-500 hover:bg-red-600 transition-colors cursor-pointer 
                                    uppercase font-bold text-xs px-3 py-1 text-white rounded-lg"
                                />
                            </form>
                        @endif
                    
                    @endif

                    

                @endauth
                
            </div>
            <div class="w-full flex flex-row justify-evenly p-3">
                <p class="text-gray-800 text-sm mb-3 font-bold">{{ $user->posts->count() }} <br><span class="font-normal">@choice('publicación|publicaciones', $user->posts->count())</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{ $user->followers->count() }} <br><span class="font-normal">@choice('seguidor|seguidores', $user->followers->count())</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{ $user->followings->count() }} <br><span class="font-normal">@choice('seguido|seguidos', $user->followings->count())</span></p>
            </div>
        </div>
    </div>
</div>

<section class="container mx-auto mt-10">
    <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

    @if ($posts->count() > 0)
        <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show', ['post'=>$post, 'user'=>$user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen - Post {{ $post->titulo }}">
                        </a>
                    </div>
                @endforeach

        </div>
        <div>
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="uppercase text-gray-600 text-sm font-bold text-center">No hay publicaciones aún</p>
    @endif

</section>
@endsection