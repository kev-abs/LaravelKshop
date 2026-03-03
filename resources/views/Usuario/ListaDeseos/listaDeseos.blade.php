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
  <title>K-SHOP | Lista de Deseos</title>
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
    <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex">

<input 
type="text" 
name="nombre"
value="{{ request('nombre') }}"
class="form-control me-2"
placeholder="Buscar productos..."
>

<button class="btn btn-dark">
<i class="bi bi-search"></i>
</button>

</form>
      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-dark">
              Cerrar sesión
          </button>
      </form>
  </div>
</header>

<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="menuCliente">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menú Cliente</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="list-unstyled">
      <li class="mb-3">
        <a href="{{ route('cliente.perfil') }}" class="text-white text-decoration-none">
          <i class="bi bi-person-circle me-2"></i> Mi Perfil
        </a>
      </li>
      <li class="mb-3">
        <a href="{{ route('cliente.listaDeseos') }}" class="text-white text-decoration-none">
          <i class="bi bi-heart me-2"></i> Lista de Deseos
        </a>
      </li>
      <li class="mb-3">
        <a href="#" class="text-white text-decoration-none">
          <i class="bi bi-cart me-2"></i> Carrito
        </a>
      </li>
    </ul>
  </div>
</div>

<div class="ps-3 py-2">
  <button class="btn btn-light shadow-sm rounded-4" data-bs-toggle="offcanvas" data-bs-target="#menuCliente">
    <i class="bi bi-list fs-4"></i> Menú
  </button>
</div>

<main class="container my-5">
  <h3 class="fw-bold text-center mb-4">Mi Lista de Deseos</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(count($deseos) > 0)
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
      @foreach($deseos as $d)
        <div class="col">
          <div class="card h-100 shadow-sm border-0">
            <img src="http://localhost:8080/uploads/productos/{{ $d->Imagen ?? '' }}" class="card-img-top" style="height:180px; object-fit:cover">
            <div class="card-body text-center">
              <h6 class="fw-bold">{{ $d->Nombre ?? '' }}</h6>
              <p class="fw-bold mb-2">$ {{ number_format($d->Precio ?? 0, 0, ',', '.') }}</p>
              <form action="{{ route('cliente.listaDeseos.eliminar', $d->ID_Lista) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger btn-sm">Eliminar</button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>

  @else
    <div class="alert alert-warning text-center">No tienes productos en tu lista de deseos.</div>
  @endif
</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 K-SHOP - Panel Cliente</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
