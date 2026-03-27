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
    </div>
    </nav>

    <div class="container my-5 text-center">
        <h1 class="fw-bold">Modulo de Inventario</h1>
        <p class="text-muted">
        Desde aquí podrás gestionar el <strong>Inventario</strong> de K-SHOP.
        </p>

       <div class="row g-4 justify-content-center">
            <!-- Card Cupones -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-ticket-perforated-fill fs-1 text-warning mb-3"></i>
                        <h4 class="fw-bold">Gestión de Cupones</h4>
                        <p class="text-muted">Consultar, agregar, actualizar o eliminar cupones.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{route('cupon.consultar')}}" class="btn btn-outline-dark">
                                <i class="bi bi-search"></i> Consultar
                            </a>
                            <a href="{{route('cupon.agregar')}}" class="btn btn-outline-dark">
                                <i class="bi bi-plus-circle"></i> Agregar
                            </a>
                            <a href="{{route('cupon.editarVista')}}" class="btn btn-outline-dark">
                                <i class="bi bi-pencil-square"></i> Actualizar / Eliminar
                            </a>
                             <a href="{{ route('cupon.asignarVista') }}" class="btn btn-outline-dark">
                                 <i class="bi bi-pencil-square"></i> Asignar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Inventario -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-box-seam fs-1 text-primary mb-3"></i>
                        <h4 class="fw-bold">Gestion de Inventario</h4>
                        <p class="text-muted">Visualizar stock, alertas y estado del inventario.</p>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('productos.inventario') }}" class="btn btn-outline-dark">
                                <i class="bi bi-eye"></i> Ver Inventario
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Proveedores -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-truck fs-1 text-secondary mb-3"></i>
                        <h4 class="fw-bold">Gestión de Proveedores</h4>
                        <p class="text-muted">Consultar, agregar, actualizar o eliminar proveedores.</p>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('proveedor.consultar') }}" class="btn btn-outline-dark">
                                <i class="bi bi-search"></i> Consultar
                            </a>

                            <a href="{{ route('proveedor.agregar') }}" class="btn btn-outline-dark">
                                <i class="bi bi-plus-circle"></i> Agregar
                            </a>

                            <a href="{{ route('proveedor.editar') }}" class="btn btn-outline-dark">
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
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

</body>
</html>
