@extends('layouts.app')

@section('titulo')
Página Principal
@endsection

@section('contenido')
<div class="container mx-auto px-4 max-w-2xl">
    <div class="flex flex-col justify-center gap-12">
        @if($posts->count())

        @foreach ($posts as $post)
            <div class="w-full">
                <div class="flex items-center gap-4 mb-4">
                    <img class="size-8 rounded-full"
                        src="{{ $post->user->imagen ? asset('perfiles') . '/' . $post->user->imagen : asset('img/user-profile.jpg') }}" />
                    <div>
                        <a class="font-bold" href="{{ route('posts.index', ['user'=>$post->user]) }}">{{
                            $post->user->username
                            }}</a>
                        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="w-full">
                    <a href="{{ route('posts.show', ['post'=>$post, 'user'=>auth()->user()]) }}"><img
                            src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Post - {{ $post->titulo }}"></a>
                </div>
                <div class="flex gap-4 items-center mt-4">
                    <livewire:like-post :post="$post" />
                    <a href="{{ route('posts.show', ['post'=>$post, 'user'=>auth()->user()]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-9 h-9">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach

        <p class="text-center font-bold uppercase text-gray-500">¡Perfecto! Ahora estás al día</p>

        @else
            <p class="text-center font-bold uppercase text-gray-500">No hay publicaciones para mostrar. ¡Empieza a seguir gente!</p>
        @endif

    </div>
</div>
@endsection