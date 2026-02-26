<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>K-SHOP - Módulo Usuarios</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a class="navbar-brand fw-bold" href="{{ route('panel.admin') }}">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="K-Shop" width="60" class="me-2">
            K-SHOP | Admin
            </a>
        </div>

        <nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-dark">
                    Cerrar sesión
                </button>
            </form>
        </nav>
    </div>
</header>

<!-- CONTENIDO -->
<main class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Módulo de Usuarios</h2>
        <p class="text-muted">
        Desde aquí podrás gestionar a los <strong>clientes</strong> y <strong>empleados</strong> de K-SHOP.
        </p>
    </div>

    <div class="row g-4">
        <!-- Card Clientes -->
        <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
            <i class="bi bi-people-fill fs-1 text-primary mb-3"></i>
            <h4 class="fw-bold">Gestión de Clientes</h4>
            <p class="text-muted">
                Registra, consulta, actualiza y elimina la información de los clientes.
            </p>
            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('clientes.consultar') }}" class="btn btn-outline-dark">
                    <i class="bi bi-search"></i> Consultar
                </a>
                <a href="{{ route('clientes.agregar') }}" class="btn btn-outline-dark">
                    <i class="bi bi-person-plus"></i> Agregar
                </a>
            </div>
            </div>
        </div>
        </div>

        <!-- Card Empleados -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-person-badge-fill fs-1 text-success mb-3"></i>
                    <h4 class="fw-bold">Gestión de Empleados</h4>
                    <p class="text-muted">
                        Administra a los empleados de la tienda: registro, consulta, actualización y eliminación.
                    </p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('empleados.consultar') }}" class="btn btn-outline-dark">
                            <i class="bi bi-search"></i> Consultar
                        </a>
                        <a href="{{ route('empleados.agregar') }}" class="btn btn-outline-dark">
                            <i class="bi bi-person-plus"></i> Agregar
                        </a>
                        <a href="{{ route('empleados.editar') }}" class="btn btn-outline-dark">
                            <i class="bi bi-pencil-square"></i> Actualizar/Eliminar
                        </a>
                    </div>
                </div>
            </div>
        </div>


    <!-- Nota informativa -->
    <div class="alert alert-info mt-5">
        <h5 class="fw-bold"><i class="bi bi-lightbulb"></i> Consejo:</h5>
        Mantén actualizada la información de clientes y empleados para un mejor control del sistema.
    </div>
</main>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
    <div class="container">
        <div class="mb-3">
        <a href="#" class="text-white me-3">Términos</a>
        <a href="#" class="text-white me-3">Privacidad</a>
        <a href="#" class="text-white">Ayuda</a>
        </div>
        <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
