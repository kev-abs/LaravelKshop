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
<header class="bg-white sticky-top border-bottom shadow-sm">
  <nav class="navbar navbar-expand-lg container">

    <!-- LOGO -->
    <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('inicio') }}">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="60" class="me-2">
      K-SHOP
    </a>

    <!-- BOTÓN HAMBURGUESA -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarKshop">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- CONTENIDO -->
    <div class="collapse navbar-collapse" id="navbarKshop">

      <!-- BÚSQUEDA (solo en PC centrada) -->
      <form action="{{ route('productos.buscar') }}" method="GET" 
            class="d-none d-lg-flex mx-auto" style="max-width: 400px; width:100%;">

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

      <!-- MENÚ -->
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">

        <li class="nav-item">
          <a href="{{ route('productos.vistaCatalogo') }}" class="nav-link">
            Productos
          </a>
        </li>

        <!-- BUSCADOR EN MÓVIL -->
        <li class="nav-item d-lg-none w-100 my-2">
          <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex">
            <input type="text" name="nombre" class="form-control me-2" placeholder="Buscar...">
            <button class="btn btn-dark">
              <i class="bi bi-search"></i>
            </button>
          </form>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="bi bi-cart-fill"></i>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('login') }}" class="btn btn-outline-dark">
            <i class="bi bi-person-circle me-1"></i>
            <span class="d-none d-lg-inline">Iniciar sesión</span>
          </a>
        </li>

      </ul>

    </div>

  </nav>
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

            <input type="email" name="correo"class="form-control form-control-lg rounded-0"required>
          </div>
          <!-- PASSWORD -->
          <div class="mb-2">
            <label class="form-label fw-semibold small">
              Contraseña *
            </label>

            <div class="input-group">

              <input type="password" name="contrasena"id="passwordInput"class="form-control form-control-lg rounded-0"required>

              <button type="button" class="btn btn-outline-dark" onclick="togglePassword()">
                <i class="bi bi-eye" id="eyeIcon"></i>
              </button>

            </div>
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



<!-- FOOTER -->
<footer class="bg-dark text-white pt-5">
  <div class="container text-center text-md-start">
    <div class="row">

      <div class="col-md-4 mb-4">
        <h5>K-SHOP</h5>
        <p>Moda moderna y urbana.</p>
      </div>

      <div class="col-md-3 mb-4">
        <h6 class="fw-bold">Ayuda</h6>
        <ul class="list-unstyled small">
          <li><a href="{{ route('faq') }}" class="text-white text-decoration-none">Preguntas frecuentes</a></li>
          <li><a href="{{ route('contacto') }}" class="text-white text-decoration-none">Contáctanos</a></li>
          <li><a href="{{ route('terminos') }}" class="text-white text-decoration-none">Sobre nosotros</a></li>
        </ul>
      </div>

    </div>

    <div class="text-center border-top pt-3">
      &copy; 2026 K-SHOP
    </div>
  </div>
</footer>
<script>
function togglePassword() {
    const input = document.getElementById("passwordInput");
    const icon = document.getElementById("eyeIcon");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
}
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>