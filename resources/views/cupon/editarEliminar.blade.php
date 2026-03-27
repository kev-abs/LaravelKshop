<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualizar / Eliminar Cupón</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
         <a class="d-flex align-items-center text-decoration-none" href="{{ route('cupon.inventarioVista') }}">
          <img src="{{asset('img/logo_kshopsinfondo.png')}}" alt="Logo K-Shop" width="83" class="me-2">
          <span class="fw-bold text-dark">K-SHOP | ACTUALIZAR CUPÓN</span>
        </a>
      </div>
  </div>
</header>

<div class="container py-5 flex-grow-1">

  <h1 class="mb-4 text-center">Actualizar / Eliminar Cupón</h1>

  @if (session('mensaje'))
      <div class="alert alert-info text-center">{{ session('mensaje') }}</div>
  @endif


  <!-- ========================
          ACTUALIZAR CUPÓN
  ========================== -->
  <h2 class="mb-4 text-center">Actualizar Cupón</h2>

  <form method="POST" action="{{ route('cupon.update') }}" class="text-center">
      @csrf
      @method('PUT')

      <div class="row mb-3 justify-content-center">

        <div class="col-md-2">
          <label class="form-label">ID Cupón</label>
          <input type="number" class="form-control text-center" name="id_Cupon" required>
        </div>

        <div class="col-md-3">
          <label class="form-label">Código</label>
          <input type="text" class="form-control text-center" name="codigo" required>
        </div>

        <div class="col-md-3">
          <label class="form-label">Descuento (%)</label>
          <input type="number" class="form-control text-center" name="descuento" step="0.01" required>
        </div>

        <div class="col-md-3">
          <label class="form-label">Fecha Expiración</label>
          <input type="date" class="form-control text-center" name="fecha_expiracion" required>
        </div>

      </div>

      <button type="submit" class="btn btn-warning">Actualizar Cupón</button>
  </form>


  <!-- ========================
          ELIMINAR CUPÓN
  ========================== -->
  <h2 class="mb-4 text-center mt-5">Eliminar Cupón</h2>

  <form method="POST" action="{{ route('cupon.eliminar') }}" class="text-center">
      @csrf
      @method('DELETE')

      <div class="row mb-3 justify-content-center">
          <div class="col-lg-4">
              <label class="form-label">ID Cupón</label>
              <input type="number" class="form-control text-center" name="id_Cupon" required>
          </div>
      </div>

      <button type="submit" class="btn btn-danger">Eliminar</button>
  </form>
</div>


<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

</body>
</html>
