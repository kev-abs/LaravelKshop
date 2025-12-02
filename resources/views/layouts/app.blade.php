<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KSHOP - Inicio</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- Tus estilos --}}
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

    {{-- NAVBAR --}}
    @include('layouts.navbar')

    {{-- CONTENIDO --}}
    <main class="container mt-4">
        @yield('contenido')
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')

    {{-- JS --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
