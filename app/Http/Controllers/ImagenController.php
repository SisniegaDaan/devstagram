<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        // Creando un nombre identificador al archivo
        $imagen = $request->file("file");
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // Ajustando la imagen a una forma cuadrada con Intervention
        $imagenFinal = Image::make($imagen);
        $imagenFinal->fit(1000, 1000);

        // Guardamos el archivo dentro de un path (public/uploads)
        $imagen->move(public_path("/uploads"));
        return response()->json($nombreImagen);
    }
}
