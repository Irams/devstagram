@extends('layouts.app')

@section('titulo')
    Editar perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{route('perfil.store')}}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mt-5">
                    <label for="username" 
                           class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text"
                           name="username"
                           id="username"
                           placeholder="Tu nombre usuario"
                           class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                           value={{ auth()->user()->username }}>
                
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>  
                    @enderror
                </div>

                <div class="mt-5">
                    <label for="email" 
                           class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input type="text"
                           name="email"
                           id="email"
                           placeholder="Tu nombre usuario"
                           class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                           value={{ auth()->user()->email }}>
                
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>  
                    @enderror
                </div>

                <div class="mt-5">
                    <label for="imagen" 
                           class="mb-2 block uppercase text-gray-500 font-bold">
                        Foto de perfil
                    </label>
                    <input type="file"
                           name="imagen"
                           id="imagen"
                           class="border p-3 w-full rounded-lg 
                           value=""
                           accept=".jpg, .jpeg, .png"
                    >

                    <div class="mt-5">
                        <label for="oldpassword" 
                               class="mb-2 block uppercase text-gray-500 font-bold">
                            Antiguo password
                        </label>
                        <input type="password"
                               name="oldpassword"
                               id="oldpassword"
                               placeholder="Tu contraseña actual"
                               class="border p-3 w-full rounded-lg @error('oldpassword') border-red-500 @enderror">
                            @error('oldpassword')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>  
                            @enderror
                    </div>

                    <div class="mt-5">
                        <label for="password" 
                               class="mb-2 block uppercase text-gray-500 font-bold">
                            Nuevo password
                        </label>
                        <input type="password"
                               name="password"
                               id="password"
                               placeholder="Nueva Contraseña"
                               class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>  
                            @enderror
                    </div>

                    <div class="mt-5">
                        <label for="password_confirmation" 
                               class="mb-2 block uppercase text-gray-500 font-bold">
                            Confirmar nuevo password
                        </label>
                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               placeholder="Repite tu nueva contraseña"
                               class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror">
                            @error('password_confirmation')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>  
                            @enderror
                    </div>

                    <input type="submit" 
                       value="Actualizar"
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
                </div>
                {{-- @if ($request->password)
                    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                        <p>Tu contraseña se actualizó correctamente</p>
                    </div> 
                @endif --}}
            </form>
        </div>
    </div>
@endsection