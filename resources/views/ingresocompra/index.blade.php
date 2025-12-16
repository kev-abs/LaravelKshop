<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Consultar Ingresos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
          <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="83" class="me-2">
          <span class="fw-bold text-dark">K-SHOP | Ingreso Compra</span>
      </div>
      <nav>
          <a href="{{ route('logout') }}" class="btn btn-outline-dark">Cerrar Sesión</a>
      </nav>
  </div>
</header>

<div class="container py-5 flex-grow-1">

  <h1 class="mb-4 text-center">Consultar Ingresos de Compra</h1>

  @if($ingresos->count() > 0)
  <table class="table table-bordered table-striped text-center">
    <thead class="table-info">
      <tr>
        <th>ID</th>
        <th>Empleado</th>
        <th>Proveedor</th>
        <th>Fecha</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($ingresos as $i)
      <tr>
        <td>{{ $i->ID_Ingreso }}</td>
        <td>{{ $i->ID_Empleado }}</td>
        <td>{{ $i->ID_Proveedor }}</td>
        <td>{{ $i->Fecha_Ingreso }}</td>
        <td>${{ $i->Total }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
    <div class="alert alert-warning text-center">
      No hay ingresos registrados
    </div>
  @endif

  <div class="text-center mt-4">
    <a href="{{ route('cupon.inventarioVista') }}" class="btn btn-outline-secondary btn-lg w-50">
      Volver al Panel
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
