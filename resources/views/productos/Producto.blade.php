<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>K-SHOP - Módulo Productos</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- BARRA SUPERIOR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">

            <a class="navbar-brand fw-bold" href="#">
                K-SHOP
            </a>

            <!-- Buscador -->
            <form class="d-none d-md-flex mx-auto w-50" role="search">
                <input class="form-control" type="search" placeholder="Buscar en productos..." aria-label="Buscar">
            </form>

            <div class="d-flex">
                <a href="{{ route('logout') }}" class="btn btn-outline-dark">
                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                </a>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO -->
    <main class="container my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Módulo de Productos</h2>
            <p class="text-muted">
                Desde aquí podrás gestionar el <strong>inventario</strong> y las <strong>categorías</strong> de productos en K-SHOP.
            </p>
        </div>

        <div class="row g-4">

            <!-- Card Productos -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-box-seam fs-1 text-primary mb-3"></i>

                        <h4 class="fw-bold">Gestión de Productos</h4>
                        <p class="text-muted">Registra, consulta y actualiza productos de la tienda.</p>

                        <div class="d-flex justify-content-center gap-2">

                            <!-- CONSULTAR -->
                            <a href="{{ route('productos.index') }}" class="btn btn-outline-dark">
                                <i class="bi bi-search"></i> Consultar
                            </a>

                            <!-- AGREGAR -->
                            <a href="{{ route('productos.create') }}" class="btn btn-outline-dark">
                                <i class="bi bi-plus-circle"></i> Agregar
                            </a>

                            <!-- ACTUALIZAR -->
                            <a href="{{ route('productos.edit') }}" class="btn btn-outline-dark">
                                <i class="bi bi-pencil-square"></i> Actualizar
                            </a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
