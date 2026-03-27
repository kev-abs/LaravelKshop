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
            <a class="d-flex align-items-center text-decoration-none" href="{{ route('cupon.inventarioVista') }}">
                <img src="{{asset('img/logo_kshopsinfondo.png')}}" alt="Logo K-Shop" width="83" class="me-2">
                <span class="fw-bold text-dark">K-SHOP | AGREGAR PROVEEDOR</span>
            </a>
        </div>
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

        <div class="text-center">
            <button type="submit" class="btn btn-warning px-4">
                <i class="bi bi-truck"></i> Agregar Proveedor
            </button>
        </div>
    </form>

</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

</body>
</html>