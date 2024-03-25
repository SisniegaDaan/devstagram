@extends('layouts.app')

@section('titulo')
Devstagram
@endsection

@section('contenido')
<div class="flex justify-center">
    <div class="flex flex-col justify-center w-8/12 lg:flex-row">
        <div class="w-full flex justify-center bg-red-400 lg:w-6/12">
            <img class="w-6/12" src="{{ asset('img/user-profile.jpg')}}"/>
        </div>
        <div class="flex flex-col justify-center w-full lg:w-6/12 bg-blue-300 text-center">
            <p class="text-gray-700 text-2xl font-bold p-3">{{ $user->username }}</p>
            <div class="w-full flex flex-row justify-evenly p-3">
                <p class="text-gray-800 text-sm mb-3 font-bold">0 <br><span class="font-normal">publicaciones</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">0 <br><span class="font-normal">seguidores</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold">0 <br><span class="font-normal">seguidos</span></p>
            </div>
            
        </div>
    </div>
</div>
@endsection