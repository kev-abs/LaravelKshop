<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="83" class="me-2">
            <span class="fw-bold">K-SHOP | Proveedores</span>
        </div>
        <nav>
            <a href="{{ route('logout') }}" class="btn btn-outline-dark">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<div class="container py-5 flex-grow-1">

    <h2 class="text-center mb-4">Agregar Proveedor</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('proveedor.guardar') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Empresa</label>
            <input type="text" name="Nombre_Empresa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contacto</label>
            <input type="text" name="Contacto" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="Telefono" class="form-control">
        </div>

        <div class="mb-3">
            <label>Correo</label>
            <input type="email" name="Correo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="Direccion" class="form-control">
        </div>

        <button class="btn btn-success w-100 mb-3">Guardar</button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('cupon.inventarioVista') }}" class="btn btn-outline-secondary btn-lg w-50">
            <i class="bi bi-arrow-left me-2"></i> Volver al Panel
        </a>
    </div>

</div>

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