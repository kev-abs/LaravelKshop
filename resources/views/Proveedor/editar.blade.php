<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualizar / Eliminar Proveedor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
          <a class="d-flex align-items-center text-decoration-none" href="{{ route('cupon.inventarioVista') }}">
          <img src="{{asset('img/logo_kshopsinfondo.png')}}" alt="Logo K-Shop" width="83" class="me-2">
          <span class="fw-bold text-dark">K-SHOP | EDITAR PROVEEDOR</span>
        </a>
      </div>
  </div>
</header>

<div class="container py-5 flex-grow-1">

  <h1 class="mb-4 text-center">Actualizar / Eliminar Proveedor</h1>

  @if (session('mensaje'))
      <div class="alert alert-info text-center">{{ session('mensaje') }}</div>
  @endif

  <!-- ========================
        BUSCAR PROVEEDOR
========================= -->
    <form method="POST" action="{{ route('proveedor.buscar') }}" class="text-center mb-4">
        @csrf

        <div class="row justify-content-center">
            <div class="col-md-4">
                <input type="number" name="ID_Proveedor"
                    class="form-control text-center"
                    placeholder="Ingrese ID del proveedor"
                    required>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    Buscar
                </button>
            </div>
        </div>
    </form>
    @if(isset($proveedor))
    
  <!-- ========================
          ACTUALIZAR PROVEEDOR
  ========================== -->
  <h2 class="mb-4 text-center">Actualizar Proveedor</h2>

    <form method="POST" action="{{ route('proveedor.update') }}" class="text-center">
        @csrf
        @method('PUT')

            <input type="hidden" name="ID_Proveedor"
                value="{{ $proveedor->ID_Proveedor }}">

            <div class="row mb-3 justify-content-center">

                <div class="col-md-3">
                    <label>Empresa</label>
                    <input type="text" name="Nombre_Empresa"
                        class="form-control text-center"
                        value="{{ $proveedor->Nombre_Empresa }}" required>
                </div>

                <div class="col-md-3">
                    <label>Contacto</label>
                    <input type="text" name="Contacto"
                        class="form-control text-center"
                        value="{{ $proveedor->Contacto }}" required>
                </div>

                <div class="col-md-3">
                    <label>Teléfono</label>
                    <input type="text" name="Telefono"
                        class="form-control text-center"
                        value="{{ $proveedor->Telefono }}">
                </div>

                <div class="col-md-3 mt-3">
                    <label>Correo</label>
                    <input type="email" name="Correo"
                        class="form-control text-center"
                        value="{{ $proveedor->Correo }}">
                </div>

                <div class="col-md-4 mt-3">
                    <label>Dirección</label>
                    <input type="text" name="Direccion"
                        class="form-control text-center"
                        value="{{ $proveedor->Direccion }}">
                </div>

            </div>

            <button type="submit" class="btn btn-warning">
                Actualizar Proveedor
            </button>
        </form>

    @endif


  <!-- ========================
          ELIMINAR PROVEEDOR
  ========================== -->
  <h2 class="mb-4 text-center mt-5">Eliminar Proveedor</h2>

  <form method="POST" action="{{ route('proveedor.eliminar') }}" class="text-center">
      @csrf
      @method('DELETE')

      <div class="row mb-3 justify-content-center">
          <div class="col-lg-4">
              <label class="form-label">ID Proveedor</label>
              <input type="number" class="form-control text-center" name="ID_Proveedor" required>
          </div>
      </div>

      <button type="submit" class="btn btn-danger">Eliminar</button>
  </form>
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