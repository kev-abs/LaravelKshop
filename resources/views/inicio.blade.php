<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio - KSHOP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>

  <!-- ENCABEZADO -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">

    <!-- LOGO -->
    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" class="me-2">
      <a href="/ModeloVistaControlador/index.php?Controller=inicio" class="text-decoration-none fs-7 fw-bold text-dark">K-SHOP</a>
    </div>

    <!-- BARRA DE BÚSQUEDA -->
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

      <!-- INICIAR SESIÓN -->
      <a href="{{ route('login') }}" class="btn btn-outline-dark border-0 text-dark">
        <i class="bi bi-person-circle me-1"></i>Iniciar Sesión
      </a>
    </nav>
  </div>
</header>

<!-- CONTENIDO PRINCIPAL -->
<!-- CARRUSEL -->
<div id="carouselKshop" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('img/ropa caballero.jpeg') }}" class="d-block w-100 object-fit-cover" alt="Caballeros" style="height: 80vh;">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="fw-bold text-light text-shadow">Bienvenido a K-Shop</h2>
        <p class="text-light">¡Donde puedes encontrar tus gustos sin tanto andar!</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/ropa dama.jpg') }}" class="d-block w-100 object-fit-cover" alt="Damas" style="height: 80vh;">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="fw-bold text-light text-shadow">Moda femenina</h2>
        <p class="text-light">Tu estilo ideal está aquí</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/ropa niño.jpg') }}" class="d-block w-100 object-fit-cover" alt="Niños" style="height: 80vh;">
      <div class="carousel-caption d-none d-md-block">
        <h2 class="fw-bold text-light text-shadow">Moda infantil</h2>
        <p class="text-light">Para los más pequeños de casa</p>
      </div>
    </div>
  </div>
</div>

    </div>
  </div>
</section>

  <!-- SOBRE NOSOTROS -->
  <section class="py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <img src="{{ asset('img/tienda_cajera.jpg') }}" class="img-fluid rounded shadow" alt="Nuestro equipo">
        </div>
        <div class="col-md-6">
          <h3 class="fw-bold">Sobre K-Shop</h3>
          <p>Somos una tienda de moda colombiana comprometida con la diversidad y el estilo. En K-Shop creemos que vestirse bien es una forma de expresar quiénes somos. Nos dedicamos a ofrecer ropa de excelente calidad a precios accesibles para todas las edades.</p>
          <p>Con más de 10 años en el mercado, hemos aprendido a escuchar a nuestros clientes y evolucionar con sus necesidades.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- INFORMACIÓN DESTACADA -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold">¿Por qué elegirnos?</h2>
        <p class="text-muted">En K-Shop, tu satisfacción es nuestra prioridad</p>
      </div>
      <div class="row g-4">
        <div class="col-md-4 text-center">
          <i class="bi bi-truck fs-1 text-warning"></i>
          <h5 class="mt-3">Envíos rápidos</h5>
          <p>Realizamos entregas el mismo día en zonas seleccionadas. Tu pedido llega cuando lo necesitas.</p>
        </div>
        <div class="col-md-4 text-center">
          <i class="bi bi-patch-check-fill fs-1 text-warning"></i>
          <h5 class="mt-3">Calidad garantizada</h5>
          <p>Productos seleccionados con altos estándares de calidad para que siempre luzcas increíble.</p>
        </div>
        <div class="col-md-4 text-center">
          <i class="bi bi-heart-fill fs-1 text-warning"></i>
          <h5 class="mt-3">Atención personalizada</h5>
          <p>Nuestro equipo está disponible para ayudarte a elegir lo mejor para ti o para regalar.</p>
        </div>
      </div>
    </div>
  </section>

    <!-- NEWSLETTER -->
    <section class="bg-light py-5">
      <div class="container text-center">
        <h3 class="fw-bold">Suscríbete a nuestras novedades</h3>
        <p class="text-muted">Recibe descuentos y noticias exclusivas</p>
        <form class="row justify-content-center g-2">
          <div class="col-md-4">
            <input type="email" class="form-control" placeholder="Ingresa tu correo">
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-dark w-100">Suscribirme</button>
          </div>
        </form>
      </div>
    </section>
</main>

  <!-- FOOTER -->
  <footer class="bg-dark text-white pt-5 mt-auto">
    <div class="container">
      <div class="row text-center text-md-start">
        <!-- INFO -->
        <div class="col-md-3 mb-4">
          <h5 class="fw-bold">K-SHOP</h5>
          <p class="small">Tu tienda de moda en Colombia. Estilo, calidad y confianza en un solo lugar.</p>
        </div>
        <!-- ENLACES -->
        <div class="col-md-3 mb-4">
          <h6 class="fw-bold">Ayuda</h6>
          <ul class="list-unstyled small">
            <li><a href="#" class="text-white text-decoration-none">Preguntas frecuentes</a></li>
            <li><a href="#" class="text-white text-decoration-none">Políticas de devolución</a></li>
            <li><a href="#" class="text-white text-decoration-none">Contáctanos</a></li>
          </ul>
        </div>
        <!-- CATEGORÍAS -->
        <div class="col-md-3 mb-4">
          <h6 class="fw-bold">Categorías</h6>
          <ul class="list-unstyled small">
            <li><a href="#" class="text-white text-decoration-none">Hombre</a></li>
            <li><a href="#" class="text-white text-decoration-none">Mujer</a></li>
            <li><a href="#" class="text-white text-decoration-none">Niños</a></li>
          </ul>
        </div>
        <!-- REDES -->
        <div class="col-md-3 mb-4">
          <h6 class="fw-bold">Síguenos</h6>
          <div class="d-flex gap-3 justify-content-center justify-content-md-start">
            <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-white fs-5"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>
      </div>

      <div class="text-center py-3 border-top border-secondary mt-3 small">
        &copy; 2025 K-SHOP - Todos los derechos reservados | Desarrollado con PHP MVC + Bootstrap
      </div>
    </div>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
