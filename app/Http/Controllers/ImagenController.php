<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //Almacenar imágenes
    public function store(Request $request){
        // return "Imagen Controler";
        $imagen = $request->file('file');

        //Crea un nombre único para las fotos
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        $imagenServidor = Image::make($imagen);

        //Corta la imagen a 1000x1000px
        $imagenServidor->fit(1000,1000);

        $imagenPath = public_path('uploads'). '/' . $nombreImagen;

        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]); 
    }
}
