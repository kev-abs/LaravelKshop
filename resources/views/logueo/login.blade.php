<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar Sesión - K-SHOP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- ENCABEZADO -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">

    <!-- LOGO -->
    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" height="" class="me-2">
      <a href="{{ route('inicio') }}" class="text-decoration-none fs-7 fw-bold text-dark">K-SHOP</a>
    </div>

    <!-- BARRA DE BÚSQUEDA CENTRADA (invisible en móvil) -->
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

    <!-- MENÚ NAVEGACIÓN -->
    <nav class="d-flex align-items-center gap-3">
      <a href="{{ route('productos.vistaCatalogo') }}" class="nav-link text-dark">Productos</a>
    

      <!-- CARRITO -->
      <a href="index.php?Controller=carrito&action=mostrar" class="btn btn-outline-dark border-0">
        <i class="bi bi-cart-fill"></i>
      </a>

      <!-- INICIAR SESIÓN -->
      <a href="{{ route('login') }}" class="btn btn-outline-dark border-0 text-dark">
        <i class="bi bi-person-circle me-1"></i>Iniciar Sesión
      </a>
    </nav>
  </div>
</header>

<main class="container-fluid flex-fill">
  
  <div class="row min-vh-100">

    <!-- LOGIN -->
    <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white">

      <div class="w-100 px-4" style="max-width: 420px;">

        <!-- TITULO -->
        <h2 class="fw-bold mb-4">
          Iniciar sesión
        </h2>

        <!-- FORM -->
        <form action="{{ route('login.procesar') }}" method="POST">
          @csrf

          <!-- EMAIL -->
          <div class="mb-3">
            <label class="form-label fw-semibold small">
              Correo electrónico *
            </label>

            <input 
              type="email" 
              name="correo"
              class="form-control form-control-lg rounded-0"
              required
            >
          </div>

          <!-- PASSWORD -->
          <div class="mb-2">
            <label class="form-label fw-semibold small">
              Contraseña *
            </label>

            <input 
              type="password" 
              name="contrasena"
              class="form-control form-control-lg rounded-0"
              required
            >
          </div>

          <!-- FORGOT -->
          <div class="mb-3">
            <a href="{{route('password.email')}}" 
               class="text-dark small text-decoration-none">
               ¿Olvidaste tu contraseña?
            </a>
          </div>

          <!-- LOGIN BTN -->
          <button type="submit" class="btn btn-dark w-100 py-3 rounded-0 fw-semibold">
            Iniciar sesión
          </button>

        </form>

        <!-- ERROR -->
        @if(session('error'))
        <div class="alert alert-danger mt-3">
          {{ session('error') }}
        </div>
        @endif

        <!-- REGISTER -->
        <div class="mt-4">

          <h6 class="fw-bold">
            Crear una cuenta
          </h6>

          <p class="text-muted small">
            Regístrate para comprar más rápido y ver tus pedidos.
          </p>

          <a href="{{route('cliente.registrar')}}" 
             class="btn btn-outline-dark w-100 py-3 rounded-0 fw-semibold">
            Crear cuenta
          </a>

        </div>

      </div>

    </div>


    <!-- IMAGEN -->
    <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-light">

      <img 
        src="{{ asset('img/foto _inicio.png') }}"
        class="img-fluid w-75"
        alt="Productos K-SHOP"
      >

    </div>

  </div>

</main>



  <footer class="bg-dark text-white text-center py-4 mt-auto">
    <div class="container">
      <div class="mb-3">
        <a href="#" class="text-white me-3">Términos y condiciones</a>
        <a href="#" class="text-white me-3">Política de privacidad</a>
        <a href="#" class="text-white me-3">Ayuda</a>
      </div>
      <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>