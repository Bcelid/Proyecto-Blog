@extends('layout.layout')
@section('title', 'Blog')
@section('content')
    <!-- Iteramos sobre cada post en la variable $contenido -->
    @foreach ($contenido as $post)
        <div class="mt-4 w-full max-w-4xl p-5 bg-white border-gray-200 rounded-xl shadow dark:bg-gray-800 dark:border-gray-700 relative mx-auto">
            <!-- Enlace al post -->
            <a href="{{ route('post.showPost', $post->post_id) }}">
                <h5 class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->titulo }}</h5>
            </a>
            <!-- Información sobre la fecha de publicación y última modificación -->
            <p class="mb-4 text-gray-500 text-sm mt-2">
                Publicado el {{ $post->created_at->locale('es')->isoFormat('LLLL') }}
                - Última modificación el {{ $post->updated_at->locale('es')->isoFormat('LLLL') }}
                <br>
            </p>
            <!-- Contenido del post limitado a 150 caracteres para que se vea como resumen-->
            <p class="mt-2 mb-3 text-sm sm:text-base font-normal text-gray-700 dark:text-gray-400">{{ \Illuminate\Support\Str::limit(strip_tags($post->contenido), 150, '...') }}</p>
            <!-- Enlace para entrar al post -->
            <a href="{{ route('post.showPost', $post->post_id) }}" class="inline-flex items-center px-3 py-2 text-sm sm:text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Leer más
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            
            <!-- Verificamos si el usuario actual es el autor del post -->
            @if(Auth::user()->id == $post->users_id)
                <!-- Enlace para editar el post -->
                <a href="{{ route('post.editPost', $post->post_id) }}" class="mt-2 inline-flex items-center px-3 py-2 text-sm sm:text-base font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Editar
                    <svg class="h-5 w-5 text-white ml-2" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4"/>
                    </svg>
                </a>
                <!-- Enlace para eliminar el post -->
                <form style="display: inline" id="deleteForm" action="{{ route('post.destroyPost', $post) }}" method="POST" onsubmit="return confirm('¿Estás seguro que quieres eliminar el post?')">
                    @method('DELETE')
                    @csrf
                    <!-- Botón para eliminar el post -->
                    <button type="submit" class="mt-2 inline-flex items-center px-3 py-2 text-sm sm:text-base font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Eliminar
                        <svg class="h-5 w-5 text-white ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                            <line x1="10" y1="11" x2="10" y2="17"/>
                            <line x1="14" y1="11" x2="14" y2="17"/>
                        </svg>
                    </button>
                </form>
            @endif        
        </div>
    @endforeach  
@endsection

