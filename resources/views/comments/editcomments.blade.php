@extends('layout.layout')

@section('title','Editar Comentario')

@section('content')
<div class="bg-white w-full md:w-3/4 mx-auto my-auto rounded-lg shadow p-6">
    <form action="{{route('post.updatecomments',$comments)}}" method="POST" class="bg-white p-4 rounded-lg mb-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <input type="hidden" name="post_id" id="post_id" class="mt-1 p-2 border rounded w-full" value={{$comments->post_id}}>
        </div>
        <div class="mb-4">
            <input type="hidden" name="users_id" id="users_id" value="{{ $comments-> users_id }}" class="mt-1 p-2 border rounded w-full" >
        </div>
        <div class="mb-4">
            <label for="autor" class="block text-sm font-bold text-gray-700">Comentario</label>
            <textarea name="contenidocomments" id="contenidocomments" class="trumbowyg mt-1 p-2 border rounded w-full" required> {{$comments->contenido}}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-700">Guardar</button>
        <button type="button" onclick="window.history.back()" class="bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-700">Cancelar</button>
    </form>
</div>
</form>
@endsection