<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultar Proveedores</title>
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

    <h1 class="mb-4 text-center">Consultar Proveedores</h1>

    @if($proveedores->count() > 0)
        <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Empresa</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $p)
                <tr>
                    <td>{{ $p->ID_Proveedor }}</td>
                    <td>{{ $p->Nombre_Empresa }}</td>
                    <td>{{ $p->Contacto }}</td>
                    <td>{{ $p->Telefono }}</td>
                    <td>{{ $p->Correo }}</td>
                    <td>{{ $p->Direccion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
            @else
            <div class="alert alert-warning text-center">
                No hay proveedores registrados.
            </div>  
    @endif

    <div class="text-center mt-4">
    <a href="{{ route('cupon.inventarioVista') }}" class="btn btn-outline-secondary btn-lg w-50">
      <i class="bi bi-arrow-left me-2"></i> Volver al Panel
    </a>
  </div>

</div>

</body>
</html>