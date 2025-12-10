<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">


    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('panel.admin') }}">
        <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="K-Shop" width="60" class="me-2">
        K-SHOP | Admin
        </a>

        <div class="d-flex">
        <a href="/ModeloVistaControlador/Inicio/Controlador/Logueo/CerrarSesion.php" class="btn btn-outline-dark">
            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
        </a>
        </div>
    </div>
    </nav>

    <div class="container my-5 text-center">
        <h1 class="fw-bold">Modulo de Inventario</h1>
        <p class="text-muted">
        Desde aquí podrás gestionar a los <strong>Ingresos De Compra</strong> y <strong>Cupones</strong> de K-SHOP.
        </p>

       <div class="row g-4 justify-content-center">
            <!-- Card Ingresos de Compra -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-bag-fill fs-1 text-success mb-3"></i>
                        <h4 class="fw-bold">Gestión de Ingresos de Compra</h4>
                        <p class="text-muted">Consultar, agregar, actualizar o eliminar ingresos de compra.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="/ModeloVistaControlador/index.php?Controller=inventario&action=consultarIngresoCompra" class="btn btn-outline-dark">
                                <i class="bi bi-search"></i> Consultar
                            </a>
                            <a href="/ModeloVistaControlador/index.php?Controller=inventario&action=agregarIngresoCompra" class="btn btn-outline-dark">
                                <i class="bi bi-plus-circle"></i> Agregar
                            </a>
                            <a href="/ModeloVistaControlador/index.php?Controller=inventario&action=editarEliminarIngresoCompra" class="btn btn-outline-dark">
                                <i class="bi bi-pencil-square"></i> Actualizar / Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Cupones -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-ticket-perforated-fill fs-1 text-warning mb-3"></i>
                        <h4 class="fw-bold">Gestión de Cupones</h4>
                        <p class="text-muted">Consultar, agregar, actualizar o eliminar cupones.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{route('cupon.index')}}" class="btn btn-outline-dark">
                                <i class="bi bi-search"></i> Consultar
                            </a>
                            <a href="{{route('cupon.guardar')}}" class="btn btn-outline-dark">
                                <i class="bi bi-plus-circle"></i> Agregar
                            </a>
                            <a href="{{route('cupon.editar')}}" class="btn btn-outline-dark">
                                <i class="bi bi-pencil-square"></i> Actualizar / Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
</body>
</html>
