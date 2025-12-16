<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis Cupones | K-SHOP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <a class="navbar-brand fw-bold" href="{{ route('panel.cliente') }}">
        <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
        K-SHOP | Cliente
      </a>
    </div>
    <a href="{{ route('logout') }}" class="btn btn-outline-dark border-0">
      <i class="bi bi-box-arrow-right"></i> Salir
    </a>
  </div>
</header>

<div class="container my-5 flex-grow-1">

  <!-- TÍTULO -->
  <div class="text-center mb-4">
    <h3 class="fw-bold">
      <i class="bi bi-ticket-perforated text-warning"></i>
      Mis Cupones
    </h3>
    <p class="text-muted">Aquí podrás ver y redimir tus cupones</p>
  </div>

  <!-- CUPONES -->
  <div class="row justify-content-center">

    <!-- CUPÓN DEMO -->
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <h5 class="fw-bold">CUPON10</h5>
          <p class="text-muted mb-2">10% de descuento</p>

          <span class="badge bg-success mb-3 d-inline-block">
            Disponible
          </span>

          <div>
            <button class="btn btn-warning btn-sm">
              Redimir cupón
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- CUPÓN USADO (ejemplo visual) -->
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm border-0 opacity-75">
        <div class="card-body text-center">
          <h5 class="fw-bold">CUPON20</h5>
          <p class="text-muted mb-2">20% de descuento</p>

          <span class="badge bg-secondary">
            Usado
          </span>
        </div>
      </div>
    </div>

  </div>

  <!-- BOTÓN VOLVER -->
  <div class="text-center mt-4">
    <a href="{{ url()->previous() }}" class="btn btn-outline-dark btn-sm">
      <i class="bi bi-arrow-left"></i> Volver
    </a>
  </div>

</div>

<!-- Footer fijo al fondo -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 K-SHOP - Panel Cliente</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
