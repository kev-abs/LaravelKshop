<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>K-SHOP | Panel Cliente</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- ================= ENCABEZADO ================= -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
      <span class="fw-bold text-dark">K-SHOP | Cliente</span>
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

    <nav><a href="{{ route('logout') }}" class="btn btn-outline-dark">Cerrar Sesión</a></nav>
  </div>
</header>

<!-- ================= OFFCANVAS MENÚ ================= -->
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
        {{-- <a href="{{ route('checkout.historial') }}"> --}}

          <i class="bi bi-bag-check me-2"></i> Mis Pedidos
        </a>
      </li>

      <li class="mb-3">
        <a href="{{ route('cliente.listaDeseos') }}" class="text-white text-decoration-none">
          <i class="bi bi-heart me-2"></i> Lista de Deseos
        </a>
      </li>

      <li class="mb-3">
        <a href="{{ route('ventas.carrito.index') }}" class="text-white text-decoration-none">
          <i class="bi bi-cart me-2"></i> Carrito
        </a>
      </li>

      <li class="mb-3">
        <a href="{{ route('cliente.cupones') }}" class="text-white text-decoration-none">
          <i class="bi bi-ticket-perforated me-2"></i> Mis Cupones
        </a>
      </li>

    </ul>
  </div>
</div>

<!-- BOTÓN MENÚ -->
<div class="ps-3 py-2">
  <button class="btn btn-light shadow-sm rounded-4"
          data-bs-toggle="offcanvas"
          data-bs-target="#menuCliente">
    <i class="bi bi-list fs-4"></i> Menú
  </button>
</div>

<!-- ================= CONTENIDO ================= -->
<main class="container my-4">

  <!-- HERO PANEL -->
  <div class="bg-dark text-white rounded-4 p-5 mb-4 shadow-sm position-relative overflow-hidden">
    <div class="row align-items-center">

      <div class="col-md-8">
        <h2 class="fw-bold mb-2">
          Bienvenido, {{ $cliente->Nombre ?? 'Cliente' }}
        </h2>

        <p class="mb-4 text-light">
          Gestiona tu cuenta, revisa tus pedidos y descubre nuevos productos.
        </p>

        <a href="{{ route('cliente.productos') }}"
           class="btn btn-light rounded-3 px-4">
           Explorar productos
        </a>
      </div>

      <div class="col-md-4 text-center">
        <i class="bi bi-person-circle"
           style="font-size: 100px; opacity: 0.7;"></i>
      </div>

    </div>
  </div>


  <!-- KPIs -->
  <div class="row g-4 mb-5">

    <div class="col-md-3">
      <div class="card border-0 shadow-sm rounded-4 text-center p-4">
        <h6 class="text-muted">Pedidos</h6>
        <h3 class="fw-bold">{{ $totalPedidos }}</h3>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm rounded-4 text-center p-4">
        <h6 class="text-muted">Favoritos</h6>
        <h3 class="fw-bold">{{ $totalFavoritos }}</h3>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm rounded-4 text-center p-4">
        <h6 class="text-muted">Carrito</h6>
        <h3 class="fw-bold">{{ $totalCarrito }}</h3>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm rounded-4 text-center p-4">
        <h6 class="text-muted">Gasto Total</h6>
        <h5 class="fw-bold">
          $ {{ number_format($gastoTotal, 0, ',', '.') }}
        </h5>
      </div>
    </div>

  </div>


  <!-- ACCIONES PRINCIPALES -->
  <div class="row g-4 mb-5">

    <div class="col-md-6 col-lg-3">
      <a href="{{ route('checkout.historial') }}"
         class="text-decoration-none">

        <div class="card border-0 shadow-sm h-100 rounded-4 hover-shadow">

          <div class="card-body d-flex align-items-center">

            <div class="bg-success text-white rounded-3 p-3 me-3">
              <i class="bi bi-bag-check fs-4"></i>
            </div>

            <div>
              <h6 class="fw-bold mb-0 text-dark">Mis pedidos</h6>
              <small class="text-muted">Consulta tus compras</small>
            </div>

          </div>

        </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3">
      <a href="{{ route('cliente.listaDeseos') }}"
         class="text-decoration-none">

        <div class="card border-0 shadow-sm h-100 rounded-4">
          <div class="card-body d-flex align-items-center">

            <div class="bg-danger text-white rounded-3 p-3 me-3">
              <i class="bi bi-heart fs-4"></i>
            </div>

            <div>
              <h6 class="fw-bold mb-0 text-dark">Lista de deseos</h6>
              <small class="text-muted">Tus favoritos</small>
            </div>

          </div>
        </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3">
      <a href="{{ route('cliente.perfil') }}"
         class="text-decoration-none">

        <div class="card border-0 shadow-sm h-100 rounded-4">
          <div class="card-body d-flex align-items-center">

            <div class="bg-dark text-white rounded-3 p-3 me-3">
              <i class="bi bi-person fs-4"></i>
            </div>

            <div>
              <h6 class="fw-bold mb-0 text-dark">Mi perfil</h6>
              <small class="text-muted">Actualiza tu info</small>
            </div>

          </div>
        </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3">
      <a href="{{ route('ventas.carrito.index') }}"
         class="text-decoration-none">

        <div class="card border-0 shadow-sm h-100 rounded-4">
          <div class="card-body d-flex align-items-center">

            <div class="bg-primary text-white rounded-3 p-3 me-3">
              <i class="bi bi-cart fs-4"></i>
            </div>

            <div>
              <h6 class="fw-bold mb-0 text-dark">Mi carrito</h6>
              <small class="text-muted">Ver productos</small>
            </div>

          </div>
        </div>
      </a>
    </div>

  </div>


  <!-- PRODUCTOS RECOMENDADOS -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">Productos recomendados</h4>
    <a href="{{ route('cliente.productos') }}"
       class="text-decoration-none">
       Ver todos
    </a>
  </div>

  <div class="row g-4">

    @forelse ($productos as $p)

      <div class="col-6 col-md-4 col-lg-3">
        <div class="card border-0 shadow-sm h-100 rounded-4">

          <img src="http://localhost:8080/uploads/productos/{{ $p->Imagen }}"
               class="card-img-top rounded-top-4"
               style="height:200px; object-fit:cover;">

          <div class="card-body">

            <h6 class="fw-semibold">
              {{ $p->Nombre }}
            </h6>

            <p class="fw-bold fs-5 mb-3">
              $ {{ number_format($p->Precio, 0, ',', '.') }}
            </p>

            <a href="{{ route('cliente.productos') }}"
               class="btn btn-dark w-100 rounded-3">
              Ver producto
            </a>

          </div>

        </div>
      </div>

    @empty

      <div class="col-12 text-center text-muted">
        No hay productos disponibles
      </div>

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