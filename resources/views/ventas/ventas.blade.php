<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>K-SHOP - Módulo Ventas</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- NAVBAR (igual a Usuarios) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('panel.admin') }}">
                <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="K-Shop" width="60" class="me-2">
                K-SHOP | Admin
            </a>

            <form class="d-none d-md-flex mx-auto w-50" role="search">
                <input class="form-control" type="search" placeholder="Buscar en ventas..." aria-label="Buscar">
            </form>

            <div class="d-flex">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-dark">
                        Cerrar sesión
                    </button>
                </form>
            </div>

        </div>
    </nav>

    <!-- CONTENIDO -->
    <main class="container my-5">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Módulo de Ventas</h2>
            <p class="text-muted">
                Desde aquí podrás gestionar los <strong>pedidos</strong> y <strong>envíos</strong> realizados en K-SHOP.
            </p>
        </div>

        <div class="row g-4">

            <!-- Card Pedidos -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-cart-fill fs-1 text-primary mb-3"></i>
                        <h4 class="fw-bold">Gestión de Pedidos</h4>
                        <p class="text-muted">
                            Consulta, registra, actualiza y elimina pedidos realizados por los clientes.
                        </p>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('ventas.pedidos') }}" class="btn btn-outline-dark">
                                <i class="bi bi-search"></i> Consultar Pedido
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-truck fs-1 text-success mb-3"></i>
                        <h4 class="fw-bold">Gestión de Envíos</h4>
                        <p class="text-muted">
                            Administra los envíos de productos: seguimiento, registro y actualizaciones.
                        </p>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('ventas.envios') }}" class="btn btn-outline-dark">
                                <i class="bi bi-search"></i> Consultar Envío
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="alert alert-info mt-5">
            <h5 class="fw-bold"><i class="bi bi-lightbulb"></i> Consejo:</h5>
            Mantén actualizados los pedidos y envíos para garantizar una experiencia óptima al cliente.
        </div>

    </main>

    <!-- FOOTER (idéntico al de Usuarios) -->
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
