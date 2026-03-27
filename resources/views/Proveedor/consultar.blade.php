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
            <a class="d-flex align-items-center text-decoration-none" href="{{ route('cupon.inventarioVista') }}">
          <img src="{{asset('img/logo_kshopsinfondo.png')}}" alt="Logo K-Shop" width="83" class="me-2">
          <span class="fw-bold text-dark">K-SHOP | CONSULTAR PROVEEDORES</span>
        </a>
        </div>
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

</div>


<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>

</footer>
</body>
</html>