@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input 
                        type="text" 
                        name="username" id="username" 
                        placeholder="Tu nuevo usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                    />
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <p>Cambia tu contraseña</p>
                
                @if (session('error'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('error') }}
                    </p>
                @endif
                
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña actual
                    </label>
                    <input 
                        type="password" 
                        name="password" id="password" 
                        placeholder="Tu contraseña actual"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="newPassword" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña nueva
                    </label>
                    <input 
                        type="password" 
                        name="newPassword" id="newPassword" 
                        placeholder="Tu nueva contraseña"
                        class="border p-3 w-full rounded-lg"
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
               

                <p>Cambia tu foto de perfil</p>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de perfil
                    </label>
                    <input 
                        type="file" 
                        name="imagen" id="imagen" 
                        class="border p-3 w-full rounded-lg @error('imagen') border-red-500 @enderror"
                        accept=".jpg, jpeg, .png"
                        />
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <input
                    type="submit"
                    value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                    uppercase font-bold w-full p-3 text-white rounded-lg"/>
            </form>
        </div>
    </div>   
@endsection