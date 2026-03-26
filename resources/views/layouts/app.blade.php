<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio - KSHOP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('css/index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/iniciostyle.css') }}" rel="stylesheet">
</head>
<body>

<!-- HEADER -->
<header class="bg-white shadow-sm sticky-top border-bottom py-3">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="70" alt="K-SHOP" class="me-2">
      <a href="/" class="fw-bold text-dark fs-4 text-decoration-none">K-SHOP</a>
    </div>

    <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex">
      <input type="text" name="nombre" class="form-control me-2" placeholder="Buscar productos...">
      <button class="btn btn-dark"><i class="bi bi-search"></i></button>
    </form>

    <nav class="d-flex align-items-center gap-3">
      <a href="{{ route('productos.vistaCatalogo') }}" class="nav-link text-dark">Productos</a>
      <a href="{{ route('login') }}" class="btn btn-outline-dark border-0"><i class="bi bi-person-circle me-1"></i>Iniciar sesión</a>
    </nav>
  </div>
</header>
</html>
