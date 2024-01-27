@extends('layout.layout')

@section('title','Inicio')

@section('content')
<!-- Formulario 1 -->
<div class="text-center mx-auto my-auto">
    <!-- Formulario 1 -->
    <form action="" method="post">
        @csrf
        <input type="hidden" name="email" value="byron@gmail.com">
        <input type="hidden" name="password" value="password">
        <button class="bg-green-500 text-white font-bold py-6 px-16 sm:py-10 sm:px-32 text-lg sm:text-xl rounded-full hover:bg-green-700" type="submit">Byron Celi</button>
    </form>

    <!-- Formulario 2 -->
    <form action="" method="post" class="mt-4">
        @csrf
        <input type="hidden" name="email" value="carlos@gmail.com">
        <input type="hidden" name="password" value="password">
        <button class="bg-yellow-500 text-white font-bold py-6 px-16 sm:py-10 sm:px-32 text-lg sm:text-xl rounded-full hover:bg-yellow-700" type="submit">Carlos Diaz</button>
    </form>
</div>


@endsection