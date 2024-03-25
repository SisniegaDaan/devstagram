@extends('layouts.app')

@section('titulo')
@endsection

@section('contenido')
<div class="md:flex">
    <div class="md:w-7/12">
        <form action="/publicar" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex
        flex-col justify-center items-center"></form>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-xl md:w-5/12">
        <form action="#" method="POST" novalidate>
            @csrf
            @if (session('error'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ session('error') }}
                </p>
            @endif

            <div class="mb-5">
                <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                    Título
                </label>
                <input 
                    id="titulo" 
                    name="titulo" 
                    type="text" 
                    placeholder="Título de la publicación"
                    value="{{ old('email') }}"
                    class="border p-3 w-full rounded-lg"/>

                @error('titulo')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                    Descripción
                </label>
                <textarea 
                    id="descripcion" 
                    name="descripcion" 
                    rows="4"
                    placeholder="Escribe algo interesante sobre tu publicación..."
                    class="border p-3 w-full rounded-lg"></textarea>
                
                @error('descripcion')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            
            <input 
                type="submit"
                value="Publicar"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                uppercase font-bold w-full p-3 text-white rounded-lg"/>
        </form>
    </div>
</div>
    
@endsection