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

<header class="bg-white shadow-sm sticky-top border-bottom py-3">
  <div class="container-fluid px-4">

    <div class="row align-items-center">

      <!-- LOGO -->
      <div class="col-6 col-md-3 d-flex align-items-center">
        <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="85" class="me-2">
        <a href="/" class="fw-bold text-dark fs-3 text-decoration-none">
          K-SHOP
        </a>
      </div>

      <!-- BUSCADOR (PC) -->
      <div class="col-md-6 d-none d-md-block">
        <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex">
          <input 
            type="text" 
            name="nombre" 
            class="form-control form-control-lg me-2" 
            placeholder="Buscar productos..."
          >

          <button class="btn btn-dark px-4">
            <i class="bi bi-search"></i>
          </button>
        </form>
      </div>

      <!-- MENÚ -->
      <div class="col-6 col-md-3 d-flex justify-content-end align-items-center gap-3">

        <!-- PRODUCTOS -->
        <a href="{{ route('productos.vistaCatalogo') }}" 
           class="nav-link text-dark fw-semibold d-none d-md-block">
          Productos
        </a>

        <!-- CARRITO -->
        <a href="#" class="btn btn-outline-dark border-0">
          <i class="bi bi-cart-fill fs-5"></i>
        </a>

        <!-- LOGIN -->
        <a href="{{ route('login') }}" class="btn btn-outline-dark px-3">
          <i class="bi bi-person-circle me-1"></i>
          <span class="d-none d-md-inline">Iniciar sesión</span>
        </a>

      </div>

    </div>

    <!-- BUSCADOR MÓVIL -->
    <div class="row mt-3 d-md-none">
      <div class="col-12">
        <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex">
          <input 
            type="text" 
            name="nombre" 
            class="form-control me-2" 
            placeholder="Buscar productos..."
          >

          <button class="btn btn-dark">
            <i class="bi bi-search"></i>
          </button>
        </form>
      </div>
    </div>

  </div>
</header>
<!-- ================= HERO ================= -->
<section class="position-relative text-white" style="height:90vh;">
  <img src="{{ asset('img/unnamed.jpg') }}"
       class="w-100 h-100 position-absolute top-0 start-0"
       style="object-fit:cover; filter:brightness(0.45);">

<<<<<<< HEAD
  <div class="container position-relative h-100 d-flex flex-column justify-content-center">
    <h1 class="display-2 fw-bold">K-SHOP</h1>
    <p class="fs-4 text-light">Moda urbana y estilo contemporáneo</p>

    <a href="{{ route('productos.vistaCatalogo') }}"
       class="btn btn-light text-dark px-5 py-2 rounded-pill mt-3 fw-semibold">
       <i class="bi bi-bag me-2"></i> Explorar colección
    </a>
=======
<!-- ====================== CARRUSEL ====================== -->
<div id="carouselKshop" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselKshop" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carouselKshop" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carouselKshop" data-bs-slide-to="2"></button>
>>>>>>> parent of 4cb488b (categorizacion cliente)
  </div>
</section>

<<<<<<< HEAD
<!-- ================= CATEGORÍAS (MEJORADAS) ================= -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center fw-bold mb-5">CATEGORÍAS</h2>

    <div class="row g-4">

      @foreach ([
        ['nombre'=>'Accesorios','icon'=>'bi-watch'],
        ['nombre'=>'Camisetas','icon'=>'bi-person'],
        ['nombre'=>'Chaquetas','icon'=>'bi-cloud'],
        ['nombre'=>'Pantalones','icon'=>'bi-columns'],
        ['nombre'=>'Calzado','icon'=>'bi-shop']
=======
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">
      <a href="{{ route('productos.vistaCatalogo') }}">
        <img src="{{ asset('img/ropa caballero.jpeg') }}" class="d-block w-100" alt="Moda masculina">
      </a>
      <div class="carousel-caption">
        <h1 class="text-light">K-SHOP</h1>
        <p>Estilo sin límites para todos los gustos</p>
        <a href="{{ route('productos.vistaCatalogo') }}" class="btn btn-light fw-semibold text-dark px-4 py-2 mt-3">Explorar colección</a>
      </div>
    </div>

    <div class="carousel-item" data-bs-interval="5000">
      <a href="{{ route('productos.vistaCatalogo') }}">
        <img src="{{ asset('img/ropa dama.jpg') }}" class="d-block w-100" alt="Moda femenina">
      </a>
      <div class="carousel-caption">
        <h1 class="text-light">Moda Femenina</h1>
        <p>Tu actitud, tu tendencia, tu esencia</p>
        <a href="{{ route('productos.vistaCatalogo') }}" class="btn btn-light fw-semibold px-4 py-2 mt-3">Ver estilos</a>
      </div>
    </div>

    <div class="carousel-item" data-bs-interval="5000">
      <a href="{{ route('productos.vistaCatalogo') }}">
        <img src="{{ asset('img/ropa niño.jpg') }}" class="d-block w-100" alt="Moda infantil">
      </a>
      <div class="carousel-caption">
        <h1 class="text-light">Moda Infantil</h1>
        <p>Comodidad y alegría para los más pequeños</p>
        <a href="{{ route('productos.vistaCatalogo') }}" class="btn btn-light fw-semibold text-dark px-4 py-2 mt-3">Descubrir</a>
      </div>
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselKshop" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselKshop" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- ====================== CATEGORÍAS ====================== -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="fw-bold mb-5 text-uppercase text-dark">Explora por categoría</h2>
    <div class="row g-4">
      @foreach([
        ['img' => 'img/RopaDama2.png', 'titulo' => 'Moda femenina'],
        ['img' => 'img/RopaCaballero2.png', 'titulo' => 'Moda masculina'],
        ['img' => 'img/RopaNiños2.png', 'titulo' => 'Moda infantil'],
>>>>>>> parent of 4cb488b (categorizacion cliente)
      ] as $cat)

      <div class="col-6 col-md-4 col-lg">
        <a href="{{ route('productos.vistaCatalogo') }}" class="text-decoration-none">
          <div class="category-card text-center p-5 h-100 border rounded">

            <i class="bi {{ $cat['icon'] }} fs-1 mb-3"></i>
            <h5 class="fw-bold">{{ $cat['nombre'] }}</h5>

          </div>
        </a>
      </div>

      @endforeach

    </div>
  </div>
</section>

<!-- ================= MÁS VISTOS ================= -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-5">MÁS VISTOS</h2>

    <div class="row g-4">

      @foreach ($masVistos as $index => $p)

      <div class="{{ $index == 0 ? 'col-lg-6 col-md-12' : 'col-md-6 col-lg-3' }}">

        <div class="position-relative overflow-hidden featured-card">

          <img src="http://35.175.5.116:8080/uploads/productos/{{ $p->Imagen }}"
               class="w-100"
               style="height: 100%; object-fit:cover;">

          <div class="overlay d-flex flex-column justify-content-end p-3">
            <h6 class="fw-bold text-white">{{ $p->Nombre }}</h6>

            <a href="{{ route('producto.detalle', $p->ID_Producto) }}"
               class="btn btn-light btn-sm rounded-pill mt-2">
               <i class="bi bi-eye"></i> Ver
            </a>
          </div>

        </div>

      </div>

      @endforeach

    </div>
  </div>
</section>

<!-- ================= NUEVAS TENDENCIAS ================= -->
<section class="py-5">
  <div class="container-fluid">
    <h2 class="text-center fw-bold mb-4">NUEVAS TENDENCIAS</h2>

    <div class="scroll-container d-flex gap-4 px-4">

      @foreach ($tendencias as $p)
      <div class="card border-0 flex-shrink-0 product-card shadow-sm" style="width:260px;">

        <div class="overflow-hidden">
          <img src="http://35.175.5.116:8080/uploads/productos/{{ $p->Imagen }}"
               class="w-100"
               style="height:260px; object-fit:cover;">
        </div>

        <div class="card-body text-center">
          <h6 class="fw-semibold">{{ $p->Nombre }}</h6>
          <p class="fw-bold mb-0">${{ number_format($p->Precio, 0, ',', '.') }}</p>
        </div>

      </div>
      @endforeach

    </div>
  </div>
</section>

<!-- ================= RECOMENDADOS ================= -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-5">RECOMENDADOS</h2>

    <div class="row g-4">

      @foreach ($recomendados as $p)
      <div class="col-6 col-md-4 col-lg-3">

        <div class="card border-0 product-card h-100">

          <div class="position-relative overflow-hidden">
            <img src="http://35.175.5.116:8080/uploads/productos/{{ $p->Imagen }}"
                 class="w-100"
                 style="height:300px; object-fit:cover;">

            <div class="overlay d-flex justify-content-center align-items-center">
              <a href="{{ route('producto.detalle', $p->ID_Producto) }}"
                 class="btn btn-light rounded-pill">
                 <i class="bi bi-eye"></i> Ver producto
              </a>
            </div>
          </div>

          <div class="card-body text-center">
            <h6 class="fw-bold">{{ $p->Nombre }}</h6>
            <p class="fw-bold">${{ number_format($p->Precio, 0, ',', '.') }}</p>
          </div>

        </div>

      </div>
      @endforeach

    </div>
  </div>
</section>

<!-- ================= BANNER ================= -->
<section class="py-5 text-white text-center" style="background:black;">
  <div class="container">
    <h2 class="fw-bold">K-SHOP STREETWEAR</h2>
    <p>Colecciones diseñadas para destacar</p>

    <a href="{{ route('productos.vistaCatalogo') }}"
       class="btn btn-light text-dark rounded-pill px-4">
       <i class="bi bi-arrow-right"></i> Ir al catálogo
    </a>
  </div>
</section>
<!-- ====================== NEWSLETTER ====================== -->
<section class="newsletter py-5 text-center">
  <div class="container">
    <h3 class="fw-bold mb-3">¡Únete a nuestra comunidad K-SHOP!</h3>
    <p class="text-secondary mb-4">
      Recibe descuentos exclusivos y las últimas tendencias directamente en tu correo
    </p>
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('newsletter.store') }}" method="POST" class="row justify-content-center g-2">
      @csrf

      <naclasse="col-md-4 col-sm-8">
        <input type="email" name="correo" class="form-control form-control-lg" placeholder="Tu correo electrónico" classed>
      </naclasse=>

      <div class="col-md-2 col-sm-4 d-flex">
        <button type="submit" class="btn btn-success btn-lg fw-semibold w-100 text-white text-center">
          Suscribirme
        </button>
      </div>
    </form>
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-white pt-5 mt-auto">
  <div class="container">
    <div class="row text-center text-md-start">
      <div class="col-md-3 mb-4">
        <h5 class="fw-bold">K-SHOP</h5>
        <p class="small">Tu tienda de moda colombiana. Estilo, calidad y confianza en un solo lugar.</p>
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

    <div class="text-center py-3 border-top border-secondary mt-3 small">
      &copy; 2026 K-SHOP | Todos los derechos reservados
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>