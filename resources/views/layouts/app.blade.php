<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Devstagram - @yield('titulo')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite('resources/css/app.css')
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between">
                <h1 class="text-3xl font-black">Devstagram</h1>
                <nav class="flex gap-4 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="/">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="/crear-cuenta">Crear cuenta</a>
                </nav>
            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>
            @yield('contenido')
        </main>

        <footer class="text-center p-5 text-gray-500 font-bold uppercase">
            Devstagram - todos los derechos reservados
        </footer>
    </body>
</html>
