@php
    if (session('rol') !== 'cliente') {
        header("Location: " . route('login'));
        exit;
    }
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>K-SHOP | Productos</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <a class="navbar-brand fw-bold" href="{{ route('panel.cliente') }}">
        <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
      K-SHOP | Cliente
      </a>
    </div>

    <form class="d-none d-md-block w-50">
      <input type="text" class="form-control" placeholder="Buscar productos...">
    </form>

    <a href="{{ route('logout') }}" class="btn btn-outline-dark border-0">
      <i class="bi bi-box-arrow-right"></i> Salir
    </a>
  </div>
</header>

<main class="container my-5">

  <h2 class="fw-bold text-center mb-4">Todos los Productos</h2>

  <div class="row g-4">
    @forelse ($productos as $p)
      <div class="col-6 col-md-4 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <img src="http://localhost/api/uploads/productos/{{ $p->Imagen }}" class="card-img-top" style="height:180px; object-fit:cover">
          <div class="card-body text-center">
            <h6 class="fw-bold">{{ $p->Nombre }}</h6>
            <p class="text-muted mb-1">Precio: $ {{ number_format($p->Precio, 0, ',', '.') }}</p>
            <p class="text-muted mb-2">Stock: {{ $p->Stock ?? 'Disponible' }}</p>

            <a href="{{ route('productos.catalogo') }}" class="btn btn-outline-dark btn-sm mb-1">
              Ver Producto
            </a>

            <form action="{{ route('cliente.listaDeseos.agregar') }}" method="POST" class="d-inline">
              @csrf
              <input type="hidden" name="ID_Producto" value="{{ $p->ID_Producto }}">
              <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-heart"></i> Añadir a Favoritos
              </button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center text-muted">No hay productos disponibles</p>
    @endforelse
  </div>

</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 K-SHOP - Panel Cliente</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
