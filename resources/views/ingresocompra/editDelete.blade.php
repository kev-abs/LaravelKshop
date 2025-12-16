<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualizar / Eliminar Ingreso</title>
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

  <h1 class="mb-4 text-center">Actualizar / Eliminar Ingreso</h1>

  @if (session('mensaje'))
      <div class="alert alert-info text-center">{{ session('mensaje') }}</div>
  @endif

  {{-- ACTUALIZAR --}}
  <h2 class="text-center mb-3">Actualizar Ingreso</h2>

  <form method="POST" action="{{ route('ingresocompra.update') }}" class="text-center">
      @csrf
      @method('PUT')

      <div class="row mb-3 justify-content-center">
        <div class="col-md-2">
          <input type="number" name="ID_Ingreso" placeholder="ID Ingreso" class="form-control text-center" required>
        </div>
        <div class="col-md-2">
          <input type="number" name="ID_Empleado" placeholder="Empleado" class="form-control text-center" required>
        </div>
        <div class="col-md-2">
          <input type="number" name="ID_Proveedor" placeholder="Proveedor" class="form-control text-center" required>
        </div>
        <div class="col-md-2">
          <input type="date" name="Fecha_Ingreso" class="form-control text-center" required>
        </div>
        <div class="col-md-2">
          <input type="number" step="0.01" name="Total" placeholder="Total" class="form-control text-center" required>
        </div>
      </div>

      <button class="btn btn-warning">Actualizar</button>
  </form>

  {{-- ELIMINAR --}}
  <h2 class="text-center mt-5">Eliminar Ingreso</h2>

  <form method="POST" action="{{ route('ingresocompra.destroy') }}" class="text-center">
      @csrf
      @method('DELETE')

      <div class="row justify-content-center mb-3">
        <div class="col-md-4">
          <input type="number" name="ID_Ingreso" placeholder="ID Ingreso" class="form-control text-center" required>
        </div>
      </div>

      <button class="btn btn-danger">Eliminar</button>
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
