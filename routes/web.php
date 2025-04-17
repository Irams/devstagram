<?php

use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LoginControler;
use App\Http\Controllers\LogoutControler;
use App\Http\Controllers\PostControler;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('principal');
});


Route::get('/registro', [RegisterController::class, 'index'])->name('register');
Route::post('/registro', [RegisterController::class, 'store']);

Route::get('/login', [LoginControler::class, 'index'])->name('login');
Route::post('/login', [LoginControler::class, 'store']);

Route::post('/logout', [LogoutControler::class, 'store'])->name('logout');

//Rutas para el perfil
Route::get('/editar-perfil',[PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil',[PerfilController::class, 'store'])->name('perfil.store');


Route::get('/posts/create', [PostControler::class, 'create'])->name('posts.create');
Route::post('/posts', [PostControler::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostControler::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostControler::class, 'destroy'])->name('posts.destroy');

Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

//Likes a las fotos
Route::post('/posts/{post}/likes',[LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes',[LikeController::class, 'destroy'])->name('posts.likes.destroy');

//Siguiendo a usarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

//Hasta el final se colocan las rutas con variables
Route::get('/{user:username}', [PostControler::class, 'index'])->name('posts.index');

