@extends('layouts.app')

@section('titulo')
Inicia sesión
@endsection

@section('contenido')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12">
        <img src="{{ asset('img/login.jpg') }}" alt="Imagen iniciar sesión">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
        <form action="{{ route('login') }}" method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    Email
                </label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    placeholder="Tu email"
                    value="{{ old('email') }}"
                    class="border p-3 w-full rounded-lg"/>

                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                    Contraseña
                </label>
                <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    placeholder="Crea tu contraseña"
                    class="border p-3 w-full rounded-lg"/>
                
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <input 
                type="submit"
                value="Iniciar sesión"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                uppercase font-bold w-full p-3 text-white rounded-lg"/>
        </form>

    </div>
</div>
@endsection