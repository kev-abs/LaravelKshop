<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultar Cupones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="/Imagenes/logo_kshopsinfondo.png" alt="Logo K-Shop" width="83" class="me-2">
            <span class="fw-bold text-dark">K-SHOP | Cupon</span>
        </div>
        <nav>
            <a href="#" class="btn btn-outline-dark">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<div class="container py-5 flex-grow-1">

    <h1 class="mb-4 text-center">Consultar Cupones</h1>

    <div class="text-center mb-4">
        <a href="{{ route('cupon.agregar') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle"></i> Agregar Cupón
        </a>
    </div>


    @if (session('mensaje'))
        <div class="alert alert-info text-center">
            {{ session('mensaje') }}
        </div>
    @endif

    @if ($cupones->count() > 0)
        <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
           <thead class="table-info">
<tr>
    <th>ID Cupón</th>
    <th>Código</th>
    <th>Descuento (%)</th>
    <th>Fecha Expiración</th>
    <th>Acciones</th>
</tr>
</thead>

<tbody>
@foreach ($cupones as $cupon)
    <tr>
        <td>{{ $cupon->ID_Cupon }}</td>
        <td>{{ $cupon->Codigo ?? $cupon->codigo }}</td>
        <td>{{ $cupon->Descuento ?? $cupon->descuento }}%</td>
        <td>{{ $cupon->Fecha_Expiracion ?? $cupon->fecha_expiracion }}</td>

        <td>
            {{-- EDITAR --}}
            <a href="{{ route('cupon.editar') }}?id={{ $cupon->ID_Cupon }}" 
            class="btn btn-warning btn-sm me-1">
            <i class="bi bi-pencil-square"></i> Editar
            </a>

            {{-- ELIMINAR --}}
            <form action="{{ route('cupon.eliminar') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="id_Cupon" value="{{ $cupon->ID_Cupon }}">
                <button class="btn btn-danger btn-sm">
                    <i class="bi bi-trash-fill"></i> Eliminar
                </button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>

        </table>
        </div>
    @else
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-triangle-fill"></i> No hay cupones registrados.
        </div>
    @endif
</div>

<div class="text-center mt-4">
    <a href="{{ route('inicio') }}" class="btn btn-outline-secondary btn-lg w-50">
        <i class="bi bi-arrow-left me-2"></i> Volver al Panel
    </a>
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
