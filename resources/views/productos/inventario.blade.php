<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
            <a class="d-flex align-items-center text-decoration-none" href="{{ route('cupon.inventarioVista') }}">
          <img src="{{asset('img/logo_kshopsinfondo.png')}}" alt="Logo K-Shop" width="83" class="me-2">
          <span class="fw-bold text-dark">K-SHOP | Inventario Productos</span>
        </a>
      </div>
  </div>
</header>

<div class="container py-5">
@if($alertas > 0)
<div class="alert alert-warning text-center shadow-sm">
    <a href="?filtro=bajo" class="fw-bold text-dark text-decoration-none">
        {{ $stockBajo }} con stock bajo
    </a> — 
    <a href="?filtro=sin" class="fw-bold text-dark text-decoration-none">
        {{ $sinStock }} sin stock
    </a>
    requieren atención.
</div>
@endif

<div class="row mb-4 text-center">

    <div class="col-md-3">
        <a href="{{ route('productos.inventario') }}" class="text-decoration-none text-dark">
        <div class="card shadow-sm p-3">
            <small>Total</small>
            <h4>{{ $total }}</h4>
        </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('productos.inventario', ['filtro' => 'bajo']) }}" class="text-decoration-none text-dark">
        <div class="card shadow-sm p-3">
            <small>Stock bajo</small>
            <h4 class="text-warning">{{ $stockBajo }}</h4>
        </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('productos.inventario', ['filtro' => 'sin']) }}" class="text-decoration-none text-dark">
        <div class="card shadow-sm p-3">
            <small>Sin stock</small>
            <h4 class="text-danger">{{ $sinStock }}</h4>
        </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('productos.inventario', ['filtro' => 'alto']) }}" class="text-decoration-none text-dark">
        <div class="card shadow-sm p-3">
            <small>Stock alto</small>
            <h4 class="text-success">{{ $stockAlto }}</h4>
        </div>
        </a>
    </div>

</div>

<div class="table-responsive">
<table class="table table-bordered text-center align-middle">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $p)
        <tr class="{{ $p->Stock <= 0 ? 'table-danger' : ($p->Stock < 10 ? 'table-warning' : '') }}">
            <td>{{ $p->ID_Producto }}</td>
            <td>{{ $p->Nombre }}</td>
            <td>${{ $p->Precio }}</td>
            <td>{{ $p->Stock }}</td>
            <td>{{ $p->Estado }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
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