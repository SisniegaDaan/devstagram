<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // Convirtiendo el valor que ingresa el usuario a un valor
        // apto para ser usado en url
        $request->request->add(['username' => Str::slug($request->username)]);
        
        $this->validate($request, [
            'username' => [
                'required', 
                'unique:users,username,'.auth()->user()->id, 'min:3', 
                'max:20', 
                'not_in:profile-edit']
        ]);

        // Encontrando en la base de datos al usuario autenticado...
        $modifiedUser = User::find(auth()->user()->id);

        if($request->imagen)
        {
            // Leer imagen y nombre del archivo
            $imagenFile = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagenFile->extension();

            // Modificar a proporción cuadrada
            $imageManager = new ImageManager(new Driver());
            $imagen = $imageManager->read($imagenFile);
            $imagen->resize(1000, 1000);

            // Guardar imagen en la carpeta local "/perfiles"
            $imagenPth = public_path('perfiles') . "/" . $nombreImagen;
            $imagen->save($imagenPth);
        }

        if($request->newPassword)
        {
            // Validar contraseña actual...
            if(!auth()->check($request->input('password'), auth()->user()->password))
            {
                // Esto crea una session para mostrar errores en las vistas
                return back()->with('error','La contraseña actual no coincide.');
            };

            $modifiedUser->password = Hash::make($request->newPassword);
        }

        // Guardando los cambios en la base de datos de
        // username y nombre del archivo nuevo que guardamos en ña carpeta /perfiles
        // Buscando el usuario que se este modificando...
        $modifiedUser->username = $request->username;
        $modifiedUser->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $modifiedUser->save();

        // Redireccionando el usuario a su perfil ya actualizado...
        return redirect()->route('posts.index', $modifiedUser);

    }
}
