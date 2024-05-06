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
        $imagenFile = $request->file("file");
        $nombreImagen = Str::uuid() . "." . $imagenFile->extension();

        // Ajustando la imagen a una forma cuadrada con Intervention
        $manager = new ImageManager(new Driver());
        $imagen = $manager->read($imagenFile);
        $imagen->resize(1000, 1000);

        // Guardamos el archivo dentro de un path (public/uploads)
        $imagenPth = public_path('uploads') . "/" . $nombreImagen;
        $imagen->save($imagenPth);
                
        // save encoded image
        return response()->json(["imagen" => $nombreImagen]);
    }
}
