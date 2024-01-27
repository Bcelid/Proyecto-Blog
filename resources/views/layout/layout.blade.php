<!-- Inicializamos el html-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Usamos el motor de vite para ejecutar archivos de estilo-->
    @vite(['resources/js/app.js','resources/css/app.css'])
    <!-- CDN para usar taildwin-->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- CDN para el plugin del editor de texto con el KEY que generamos en la pagina de TYNYMCE -->
    <script src="https://cdn.tiny.cloud/1/z0ou30f5hghycv2oqiv8efjwefbmy3k1up7iqs4lbewo6tjv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<!-- Definimos el header de la aplicacion-->
<body class="bg-blue-200 flex flex-col min-h-screen">
    <header class="bg-gray-800 text-white py-4 flex flex-col sm:flex-row justify-between items-center">
        <!-- Definimos el nombre de nuestra aplicacion y le colocamos la ruta al home -->
        <div class="ml-5 mb-2 sm:mb-0">
            <a href= {{route('home')}} class ="font-bold text-3xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl">Posteate</a>
        </div>
        <div class="flex items-center justify-center mr-5">
            <!-- usamos el metodo auth de blade para verificar si estamos autenticados y asi mostrar la bienvenida y el boton de cerrar sesion-->
            @auth
                <p class="px-2 sm:px-4 py-1 sm:py-2 text-sm sm:text-base mb-2 sm:mb-0">Bienvenido {{ Auth::user()->name }}</p>
                <form action="{{ route('logout') }}" method="POST" class="flex items-center">
                    @csrf
                    <a class="flex bg-red-500 hover:bg-red-700 text-white px-2 sm:px-4 py-1 sm:py-2 text-sm sm:text-base rounded ml-4" href="#" onclick="this.closest('form').submit()">Cerrar Sesión</a>
                </form>
            @endauth
        </div>
    </header>
    <!-- Validamos mediante el metodo unless que el boton crear post no se presente en el login ni en el formlario de crear post-->
    @unless(request()->is('post/createPost') || request()->is('/'))
    <div class="flex items-center justify-start pl-5 pt-5">
        <a href="{{ route('post.createPost') }}" class="bg-blue-500 text-white py-2 px-4 rounded-full flex items-center hover:bg-blue-700">
            <svg class="h-7 w-7 text-white-500 mr-2"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Crear un Post
        </a>
    </div>
    @endunless
    <!--Definimos el content-->
    <main class="flex-1 p-8 flex flex-col items-center justify-center">
        @yield('content')
    </main>
    

    <!-- Definimos el footer-->
    <footer class="bg-gray-800 text-white py-4 text-center">
        <p>©2024 Byron Celi Posteate.</p>
    </footer>
</body>
</html>