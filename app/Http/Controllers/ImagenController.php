<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use Intervention\Image\Laravel\Facades\Image;


class ImagenController extends Controller
{
    public function store(Request $request)
    {
        // Creando un nombre identificador al archivo
        $imagen = $request->file("file");
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // Ajustando la imagen a una forma cuadrada con Intervention
        $imgManager = new ImageManager(new Driver());
        $imagenFinal = $imgManager->create(1000, 1000);
        $imagenFinal = $imgManager->read($imagen);

        // Guardamos el archivo dentro de un path (public/uploads)
        $imagenPth = public_path('uploads') . "/" . $nombreImagen;
        $imagenFinal->save($imagenPth);
        return response()->json($nombreImagen);
    }
}
