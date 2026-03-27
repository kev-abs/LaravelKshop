<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Exportar Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<!-- HEADER -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a class="d-flex align-items-center text-decoration-none" href="{{ route('panel.admin') }}">
                <img src="{{asset('img/logo_kshopsinfondo.png')}}" alt="Logo K-Shop" width="83" class="me-2">
                <span class="fw-bold text-dark">K-SHOP | EXPORTAR DATOS</span>
            </a>
        </div>
    </div>
</header>

<!-- CONTENIDO -->
<main class="container mt-5 flex-grow-1">

    <h2 class="text-center mb-4">Exportar Datos del Sistema</h2>

    <div class="row">

        <!-- CLIENTES -->
        <div class="col-md-4 mb-3">
            <div class="card p-3 text-center border border-dark shadow-sm">
                <i class="bi bi-people-fill fs-1 text-dark"></i>
                <h5 class="mt-2">Clientes</h5>
                <p>Exportar información de clientes</p>
                <a href="/exportar/clientes" class="btn btn-warning text-dark fw-bold">
                    Exportar
                </a>
            </div>
        </div>

        <!-- EMPLEADOS -->
        <div class="col-md-4 mb-3">
            <div class="card p-3 text-center border border-dark shadow-sm">
                <i class="bi bi-person-badge-fill fs-1 text-dark"></i>
                <h5 class="mt-2">Empleados</h5>
                <p>Exportar datos del personal</p>
                <a href="/exportar/empleados" class="btn btn-warning text-dark fw-bold">
                    Exportar
                </a>
            </div>
        </div>

        <!-- PRODUCTOS -->
        <div class="col-md-4 mb-3">
            <div class="card p-3 text-center border border-dark shadow-sm">
                <i class="bi bi-box-seam fs-1 text-dark"></i>
                <h5 class="mt-2">Inventario</h5>
                <p>Exportar productos</p>
                <a href="/exportar/productos" class="btn btn-warning text-dark fw-bold">
                    Exportar
                </a>
            </div>
        </div>

    </div>

</main>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

</body>
</html>