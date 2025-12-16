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

    <form class="d-none d-md-block w-50">
      <input type="text" class="form-control" placeholder="Buscar productos...">
    </form>

    <a href="{{ route('logout') }}" class="btn btn-outline-dark border-0">
      <i class="bi bi-box-arrow-right"></i> Salir
    </a>
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
        <a href="{{ route('checkout.historial') }}" class="text-white text-decoration-none">
          <i class="bi bi-bag-check me-2"></i> Mis Pedidos
        </a>
      </li>

      <li class="mb-3">
        <a href="{{ route('cliente.listaDeseos') }}" class="text-white text-decoration-none">
          <i class="bi bi-heart me-2"></i> Lista de Deseos
        </a>
      </li>

      <li class="mb-3">
        <a href="{{ route('ventas.carrito') }}" class="text-white text-decoration-none">
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
<main class="container my-5">

  <h2 class="fw-bold text-center mb-2">
    Bienvenido a tu Panel de Cliente
  </h2>
  <p class="text-center text-muted mb-5">
    Descubre productos y gestiona tus pedidos fácilmente
  </p>

  <!-- TARJETAS -->
  <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-4 text-center mb-5">
  
    <div class="col">
      <a href="{{ route('checkout.historial') }}" class="text-decoration-none d-block h-100">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <i class="bi bi-cart-check fs-1 text-success"></i>
            <h5 class="fw-bold mt-3">Pedidos</h5>
            <p class="text-muted">Consulta tus compras</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col">
      <a href="{{ route('cliente.listaDeseos') }}" class="text-decoration-none d-block h-100">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <i class="bi bi-heart fs-1 text-danger"></i>
            <h5 class="fw-bold mt-3">Favoritos</h5>
            <p class="text-muted">Productos guardados</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col">
      <a href="{{ route('cliente.perfil') }}" class="text-decoration-none d-block h-100">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <i class="bi bi-person fs-1 text-dark"></i>
            <h5 class="fw-bold mt-3">Perfil</h5>
            <p class="text-muted">Actualiza tu información</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col">
      <a href="{{ route('cliente.productos') }}" class="text-decoration-none d-block h-100">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <i class="bi bi-bag fs-1 text-primary"></i>
            <h5 class="fw-bold mt-3">Productos</h5>
            <p class="text-muted">Explora novedades</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col">
      <a href="{{ route('cliente.cupones') }}" class="text-decoration-none d-block h-100">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <i class="bi bi-ticket-perforated fs-1 text-warning"></i>
            <h5 class="fw-bold mt-3">Cupones</h5>
            <p class="text-muted">Redime tus descuentos</p>
          </div>
        </div>
      </a>
    </div>

  </div>

  <!-- PRODUCTOS -->
  <h4 class="fw-bold text-center mb-4">Productos recomendados</h4>

  <div class="row justify-content-center">
    @forelse ($productos as $p)
      <div class="col-6 col-md-4 col-lg-3 mb-4">
        <div class="card h-100 shadow-sm border-0">

          <img src="http://localhost/api/uploads/productos/{{ $p->Imagen }}"
              class="card-img-top"
              style="height:180px; object-fit:cover">

          <div class="card-body text-center">
            <h6 class="fw-bold">{{ $p->Nombre }}</h6>

            <p class="fw-bold mb-2">
              $ {{ number_format($p->Precio, 0, ',', '.') }}
            </p>

            <a href="{{ route('cliente.productos') }}"
              class="btn btn-outline-dark btn-sm">
              Ver todos los productos
            </a>
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