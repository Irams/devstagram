<?php

use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LoginControler;
use App\Http\Controllers\LogoutControler;
use App\Http\Controllers\PostControler;
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

Route::get('/{user:username}', [PostControler::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostControler::class, 'create'])->name('posts.create');
Route::post('/posts', [PostControler::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostControler::class, 'show'])->name('posts.show');

Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');