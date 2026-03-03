<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - K-Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('panel.admin') }}">
                <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="60" class="me-2">
                K-SHOP | Admin
            </a>

            <form class="d-none d-md-flex mx-auto w-50">
                <input class="form-control" type="search" placeholder="Buscar en ventas...">
            </form>

            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-dark">
                        Cerrar sesión
                    </button>
                </form>
            </div>

        </div>
    </nav>

    {{-- CONTENIDO --}}
    <main class="flex-grow-1">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">

            <div class="mb-3">
                <a href="#" class="text-white me-3 text-decoration-none">Términos</a>
                <a href="#" class="text-white me-3 text-decoration-none">Privacidad</a>
                <a href="#" class="text-white text-decoration-none">Ayuda</a>
            </div>

            <p class="mb-0 small">
                &copy; 2025 Tienda K-Shop - Todos los derechos reservados
            </p>

        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
