@extends('layout.layout')

@section('title','Editar Post')

@section('content')
<div class="bg-white w-full md:w-3/4 mx-auto my-auto rounded-lg shadow p-6">
    <form action="{{ route('post.updatePost', ['post_id' => $post->post_id]) }}" method="POST" class="bg-white p-4 rounded-lg mb-4">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="titulo" class="block text-sm font-bold text-gray-700">Titulo:</label>
            <input type="text" name="titulo" id="titulo" class="mt-1 p-2 border rounded w-full" value={{$post->titulo}}>
        </div>
    
        <div class="mb-4">
            <label for="contenido" class="block text-sm font-bold text-gray-700">Contenido:</label>
            <textarea name="contenido" id="contenido" class="trumbowyg mt-1 p-2 border rounded w-full"> {{$post->contenido}}</textarea>
        </div>
    
        <div class="mb-4">
            <label for="autor" class="block text-sm font-bold text-gray-700">Autor:</label>
            <input type="text" name="autor" id="autor" value="{{ Auth::user()->name }}" readonly class="mt-1 p-2 border rounded w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-700">Guardar</button>
    </form>
</div>
</form>
@endsection