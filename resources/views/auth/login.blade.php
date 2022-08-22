@extends('layouts.app')

@section('titulo')
    Inicia Sesión en Desvstagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10">
        <div class="md:w-6/12">
            <img src="{{ asset('img/login.jpg') }}" alt="imagen login de usuario ">
        </div>
        <div class="md:w-6/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }}
                    </p> 
                @endif

                <div class="mt-5">
                    <label for="email" 
                           class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input type="email"
                           name="email"
                           id="email"
                           placeholder="Tu Email con el que te registraste"
                           class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                           value={{ old('email') }}>
                        @error('email')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{ $message }}
                            </p>  
                        @enderror
                </div>

                <div class="mt-5">
                    <label for="password" 
                           class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input type="password"
                           name="password"
                           id="password"
                           placeholder="Tu Contraseña"
                           class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{ $message }}
                            </p>  
                        @enderror
                </div>
                <div class="my-5">
                    <input type="checkbox" name="remember"><label class="text-gray-500 font-bold">
                        Mantener mi sesión abierta
                    </label>
                </div>

                <input type="submit" 
                       value="Iniciar Sesión"
                       class="bg-sky-600 
                              hover:bg-sky-700 
                               transition-colors 
                               cursor-pointer 
                               uppercase 
                               font-bold  
                               w-full
                               p-3
                               text-white
                               rounded-lg
                               mt-8"
                >

            </form>
        </div>
    </div>
@endsection