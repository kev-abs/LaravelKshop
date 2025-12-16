<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Ingreso de Compra</title>
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

  <h1 class="mb-4 text-center">Agregar Ingreso de Compra</h1>

  @if (session('mensaje'))
      <div class="alert alert-info text-center">{{ session('mensaje') }}</div>
  @endif

  <form method="POST" action="{{ route('ingresocompra.store') }}" class="text-center">
    @csrf

    <div class="row mb-3 justify-content-center">

      <div class="col-md-3">
        <label class="form-label">ID Empleado</label>
        <input type="number" class="form-control text-center" name="ID_Empleado" required>
      </div>

      <div class="col-md-3">
        <label class="form-label">ID Proveedor</label>
        <input type="number" class="form-control text-center" name="ID_Proveedor" required>
      </div>

      <div class="col-md-3">
        <label class="form-label">Fecha Ingreso</label>
        <input type="date" class="form-control text-center" name="Fecha_Ingreso" required>
      </div>

      <div class="col-md-3">
        <label class="form-label">Total</label>
        <input type="number" step="0.01" class="form-control text-center" name="Total" required>
      </div>

    </div>

    <button type="submit" class="btn btn-primary">Agregar Ingreso</button>
  </form>

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
