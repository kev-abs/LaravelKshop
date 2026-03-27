<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Cupón</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center" href="/ModeloVistaControlador/index.php?Controller=panel&action=manejarPeticion">
        <a class="d-flex align-items-center text-decoration-none" href="{{ route('cupon.inventarioVista') }}">
          <img src="{{asset('img/logo_kshopsinfondo.png')}}" alt="Logo K-Shop" width="83" class="me-2">
          <span class="fw-bold text-dark">K-SHOP | AGREGAR CUPÓN</span>
        </a>
      </div>
  </div>
</header>

<div class="container py-5  flex-grow-1">

  <h1 class="mb-4 text-center">Agregar Cupón</h1>

  @if (session('mensaje'))
      <div class="alert alert-info text-center">{{ session('mensaje') }}</div>
  @endif

  <form method="POST" action="{{ route('cupon.guardar') }}" class="text-center">
    @csrf

    <div class="row mb-3 justify-content-center">

      <div class="col-md-3">
        <label class="form-label">Codigo</label>
        <input type="text" class="form-control text-center" name="codigo" required>
      </div>

      <div class="col-md-3">
        <label class="form-label">Descuento (%)</label>
        <input type="number" step="0.01" class="form-control text-center" name="descuento" required>
      </div>

      <div class="col-md-3">
        <label class="form-label">Fecha Expiración</label>
        <input type="date" class="form-control text-center" name="fecha_expiracion" required>
      </div>

    </div>

    <button type="submit" class="btn btn-primary">Agregar Cupón</button>
  </form>

</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

</body>
</html>
