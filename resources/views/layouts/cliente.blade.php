<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Tus estilos -->
    <link rel="stylesheet" href="{{ asset('css/cliente.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- HEADER -->
<header class="bg-white py-3 border-bottom shadow-sm" id="headerCliente">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- LOGO -->
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="70" class="me-2">
            <a href="{{ route('panel.cliente') }}" class="text-decoration-none fs-5 fw-bold text-dark">
                K-SHOP Cliente
            </a>
        </div>

        <!-- ACCIONES -->
        <div class="d-flex align-items-center gap-2">

            <!-- BOTÓN MENÚ -->
            <button class="btn btn-outline-dark"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#menuCliente">
                <i class="bi bi-list"></i>
            </button>

            <!-- MODO OSCURO -->
            <button onclick="toggleDarkMode()" class="btn btn-outline-dark">
                <i class="bi bi-moon"></i>
            </button>

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-dark">
                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                </button>
            </form>

        </div>

    </div>
</header>

<!-- CONTENIDO -->
<main class="container-fluid flex-fill mt-4">
    @yield('content')
</main>

<!-- SCRIPT DARK MODE -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }
});

function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
}
</script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>