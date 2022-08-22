<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostControler extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user){
        // dd(auth()->user());
        // dd($user->id);}
        //Filtramos por usuario y paginamos
        $posts = Post::where('user_id', $user->id)->paginate(12);
        // dd($posts);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
    public function create(User $user){
        return view('posts.create', [
            'user' => $user
        ]);
    }
    
    public function store(Request $request){
       $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
       ]);

    //Creando los registros en la BD
    //    Post::create([
    //     'titulo' => $request->titulo,
    //     'descripcion' => $request->descripcion,
    //     'imagen' => $request->imagen,
    //     'user_id' => auth()->user()->id
    //    ]);

    //Otra forma de crear registros
    //    $post = new Post;
    //    $post->titulo = $request->titulo;
    //    $post->descripcion = $request->descripcion;
    //    $post->imagen = $request->imagen;
    //    $post->user_id = auth()->user()->id;
    //    $post->save();

    //Esta forma requiere que estén declaradas las relaciones correspondientes en los modelos involucrados
    $request->user()->posts()->create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'imagen' => $request->imagen,
        'user_id' => auth()->user()->id
    ]);


       return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post){
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }
}

