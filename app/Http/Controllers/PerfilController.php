<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //Protegiendo la ruta para que solo lo vean usuarios logueados
    public function __construct(){
        $this->middleware('auth');
    }
        
    //Mostrando el formulario de edición de perfil
    public function index(Request $request){
        //dd('aquí se muestra el formulario!');
        return view('perfil.index');
    }

    public function store(Request $request){
        // dd('Guardando cambios...');
        //Modificar el Request
        $request->request->add(['username' => Str::slug( $request->username )]);
        
        $this->validate($request, [
            'username' => [
                "required", 
                "unique:users,username,".auth()->user()->id,
                "min:3",
                "max:20",
                "not_in: twitter,facebook,editar-perfil,instagram",
                // "in:CLIENTE,PROVEEDOR,VENDEDOR" 
            ],
            'email' => [
                "required",
                "unique:users,email,".auth()->user()->id,
                "email"
            ]
        ]);
        if($request->imagen){
            $imagen = $request->file('imagen');

            //Crea un nombre único para las fotos
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::make($imagen);

            //Corta la imagen a 1000x1000px
            $imagenServidor->fit(1000,1000);

            $imagenPath = public_path('perfiles'). '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);
        }
        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        if($request->oldpassword || $request->password) {
            $this->validate($request, [
                'password' => 'required|confirmed',
            ]);
 
            if (Hash::check($request->oldpassword, auth()->user()->password)) {
                $usuario->password = Hash::make($request->password) ?? auth()->user()->password;
                $usuario->save();

            } else {
                // dd('No coincide');
                return back()->with('mensaje', 'Credenciales Incorrectas');
            }
        }

        return redirect()->route('posts.index', $usuario->username);
    }
}
