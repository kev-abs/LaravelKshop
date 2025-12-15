<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>K-SHOP - Panel Vendedor</title>

  <!-- Bootstrap y Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- ================= ENCABEZADO ================= -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">

    <!-- LOGO -->
    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" class="me-2">
      <span class="fs-7 fw-bold text-dark">K-SHOP | Vendedor</span>
    </div>

    <!-- BÚSQUEDA -->
    <form class="mx-auto d-none d-md-block w-50">
      <input type="text" class="form-control" placeholder="Buscar productos o pedidos...">
    </form>

    <!-- CERRAR SESIÓN -->
    <a href="{{ route('logout') }}" class="btn btn-outline-dark border-0">
      Cerrar Sesión
    </a>
  </div>
</header>

<!-- ================= MENÚ OFFCANVAS ================= -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="menuVendedor">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menú Vendedor</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body">
    <div class="accordion accordion-flush" id="accordionVendedor">

      <!-- PERFIL -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white"
                  data-bs-toggle="collapse" data-bs-target="#perfil">
            Perfil
          </button>
        </h2>
        <div id="perfil" class="accordion-collapse collapse">
          <ul class="list-unstyled ps-3">
            <li>
              <a href="{{ route('vendedor.perfil') }}" class="text-white text-decoration-none">
                Mi Perfil
              </a>
            </li>
          </ul>
        </div>
      </div>

      <!-- PRODUCTOS -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white"
                  data-bs-toggle="collapse" data-bs-target="#productos">
            Productos
          </button>
        </h2>
        <div id="productos" class="accordion-collapse collapse">
          <ul class="list-unstyled ps-3">
            <li><a href=" route('productos.index') }}" class="text-white text-decoration-none">➤ Consultar Productos</a></li>
            <li><a href=" route('inventario.actualizar') }}" class="text-white text-decoration-none">➤ Actualizar Stock</a></li>
          </ul>
        </div>
      </div>

      <!-- VENTAS -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white"
                  data-bs-toggle="collapse" data-bs-target="#ventas">
            Ventas
          </button>
        </h2>
        <div id="ventas" class="accordion-collapse collapse">
          <ul class="list-unstyled ps-3">
            <li><a href=" route('ventas.pedidos') }}" class="text-white text-decoration-none">➤ Pedidos</a></li>
            <li><a href=" route('ventas.envios') }}" class="text-white text-decoration-none">➤ Envíos</a></li>
          </ul>
        </div>
      </div>

      <!-- CLIENTES -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white"
                  data-bs-toggle="collapse" data-bs-target="#clientes">
            Clientes
          </button>
        </h2>
        <div id="clientes" class="accordion-collapse collapse">
          <ul class="list-unstyled ps-3">
            <li><a href="{{ route('clientes.consultar') }}" class="text-white text-decoration-none">➤ Consultar Clientes</a></li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- BOTÓN MENÚ -->
<div class="ps-3 py-2">
  <button class="btn btn-light shadow-sm rounded-4"
          data-bs-toggle="offcanvas"
          data-bs-target="#menuVendedor">
    <i class="bi bi-list fs-4"></i> Menú
  </button>
</div>

<!-- ================= CONTENIDO PRINCIPAL ================= -->
<main class="container my-5 text-center">
  <h1 class="fw-bold mb-3">Bienvenido, {{ $vendedor->Nombre }}</h1>
  <p class="lead text-muted mb-5">
    Gestiona productos, pedidos y ventas de manera rápida y eficiente.
  </p>

  <div class="row g-4">
    <!-- Productos -->
    <div class="col-md-6 col-lg-3">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
          <i class="bi bi-bag-check fs-1 text-primary"></i>
          <h5 class="fw-bold mt-3">Productos</h5>
          <p class="text-muted">Consulta y controla el stock.</p>
        </div>
      </div>
    </div>

    <!-- Pedidos -->
    <div class="col-md-6 col-lg-3">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
          <i class="bi bi-cart-check fs-1 text-success"></i>
          <h5 class="fw-bold mt-3">Pedidos</h5>
          <p class="text-muted">Gestiona pedidos de clientes.</p>
        </div>
      </div>
    </div>

    <!-- Ventas -->
    <div class="col-md-6 col-lg-3">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
          <i class="bi bi-cash-stack fs-1 text-warning"></i>
          <h5 class="fw-bold mt-3">Ventas</h5>
          <p class="text-muted">Registra ventas realizadas.</p>
        </div>
      </div>
    </div>

    <!-- Perfil -->
    <div class="col-md-6 col-lg-3">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
          <i class="bi bi-person-circle fs-1 text-dark"></i>
          <h5 class="fw-bold mt-3">Mi Perfil</h5>
          <p class="text-muted">Actualiza tu información.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- MENSAJE -->
  <div class="alert alert-light mt-5 border-start border-5 border-primary shadow-sm rounded-4">
    <h4 class="fw-bold">Tu rol es clave</h4>
    <p class="mb-0 text-secondary">
      Como vendedor eres el enlace directo con el cliente. Tu gestión hace la diferencia.
    </p>
  </div>
</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 K-SHOP - Panel Vendedor</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
