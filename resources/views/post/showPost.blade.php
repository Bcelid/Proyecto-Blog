@extends('layout.layout')
@section('title', $post -> titulo)
@section('content')     
    <div class="bg-white w-full md:w-3/4 mx-auto my-auto rounded-lg shadow p-6">
        <!-- Presentamos el post con el titulo y su contenido-->
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-center">{{$post->titulo}}</h1>
        <!-- Presentamos el contenido pero le colocamos para presentar formato html, debido a q nuestros dato tiene este formato -->
        <h3 class="text-lg md:text-xl mb-2">{!! $post-> contenido !!}</h3>
        <!-- presentamos la fecha de publicacion y su autor --> 
        <p class="mb-4 text-gray-500 text-sm md:text-base mt-2">
            Publicado el {{ \Carbon\Carbon::parse($post->created_at)->locale('es')->isoFormat('LLLL') }}
            <br>
            Creado por {{$post->name}}
        </p>
        <!-- Si el usuario autenticado es el que entro al post se le presentan las opciones de editar y eliminar-->
        @if(Auth::user()->id == $post -> users_id)
            <div class="flex flex-col md:flex-row items-center justify-center md:justify-center">
                <a href="{{route('post.editPost',$post)}}" class="m-2 inline-flex items-center px-3 py-2 text-sm sm:text-base md:text-lg font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Editar
                    <svg class="h-5 w-5 md:h-6 md:w-6 text-white ml-2" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                    </svg>
                </a>
                <!-- llamamos la ruta post.destroypost para eliminar, enviamos el meotodo delete -->
                <form style="display: inline" id="deleteForm" action="{{ route('post.destroyPost', $post) }}" method="POST" onsubmit="return confirm('¿Estás seguro que quieres eliminar el post')">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="m-2 inline-flex items-center px-3 py-2 text-sm sm:text-base md:text-lg font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Eliminar
                        <svg class="h-5 w-5 md:h-6 md:w-6 text-white ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                            <line x1="10" y1="11" x2="10" y2="17" />
                            <line x1="14" y1="11" x2="14" y2="17" />
                        </svg>
                    </button>
                </form>
            </div>
        @endif
        <form class="" action="{{route('post.savecomments',$post->post_id)}}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value= {{$post -> post_id}}>
            <input type="hidden" name="users_id" value={{Auth::user()->id}}>
            <label class="block mb-2 text-xl text-gray-700">Comenta esta publicación</label>
            <textarea class="w-full p-2 border rounded-md" name="contenido" rows="3" placeholder="Escribe tu comentario aquí"required></textarea>
            <button type="submit" class="m-2 inline-flex items-center px-3 py-2 text-sm sm:text-base md:text-lg font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Enviar
                <svg class="h-5 w-5 text-white ml-2"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="10" y1="14" x2="21" y2="3" />  <path d="M21 3L14.5 21a.55 .55 0 0 1 -1 0L10 14L3 10.5a.55 .55 0 0 1 0 -1L21 3" /></svg>
            </button>
        </form>
        <label class="block mb-2 text-xl text-gray-700">Comentarios</label>
        <!-- Iteramos los comentarios para presentarlos en formato-->
        @foreach($comentario as $coment)
            <div class="bg-gray-200 p-4 rounded-md m-4">
                <p class="mb-2">
                    <span class="font-bold text-lg">{{ $coment->nombre_usuario }}:</span>
                    {{ $coment->contenido }}
                </p>
                <p class="mb-4 text-gray-500 text-sm mt-2">
                    Publicado el {{$coment -> created_at}}
                </p>
                <!-- Acciones para el dueño del comentario -->
                @if(Auth::user()->id == $coment->id_usuarios)
                    <div class="flex space-x-4 mt-2">
                        <!-- Formulario para editar el comentario -->
                        <a href = {{route('post.editcomments',$coment->comments_id)}} class="text-blue-500 hover:underline">Editar</a>
                        <!-- Formulario para eliminar el comentario -->
                        <form action="{{ route('comments.destroycomments', $coment->comments_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endsection