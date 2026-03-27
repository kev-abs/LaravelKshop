<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio - KSHOP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <link href="{{ asset('css/index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/iniciostyle.css') }}" rel="stylesheet">

  <style>
    .product-card img {
      transition: transform 0.4s ease;
    }

    .product-card:hover img {
      transform: scale(1.08);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-size: 60% 60%;
    }

    .featured-card {
      height: 100%;
      min-height: 300px;
    }

    .featured-card img {
      height: 100%;
      object-fit: cover;
    }

    .overlay {
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.4);
      opacity: 0;
      transition: 0.3s;
    }

    .featured-card:hover .overlay,
    .product-card:hover .overlay {
      opacity: 1;
    }
  </style>
</head>

<body>

<!-- HEADER -->
<header class="bg-white shadow-sm sticky-top border-bottom py-3">
  <div class="container-fluid px-4">

    <div class="row align-items-center">

      <!-- LOGO -->
      <div class="col-6 col-md-3 d-flex align-items-center">
        <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="70" class="me-2">
        <a href="/" class="fw-bold text-dark fs-4 text-decoration-none">
          K-SHOP
        </a>
      </div>

      <!-- BUSCADOR PC -->
      <div class="col-md-6 d-none d-md-block">
        <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex">
          <input type="text" name="nombre" class="form-control form-control-lg me-2" placeholder="Buscar productos...">
          <button class="btn btn-dark px-4">
            <i class="bi bi-search"></i>
          </button>
        </form>
      </div>

      <!-- MENÚ -->
      <div class="col-6 col-md-3 d-flex justify-content-end align-items-center gap-3">

        <a href="{{ route('productos.vistaCatalogo') }}" 
           class="nav-link text-dark fw-semibold d-none d-md-block">
          Productos
        </a>

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
          <input type="text" name="nombre" class="form-control me-2" placeholder="Buscar productos...">
          <button class="btn btn-dark">
            <i class="bi bi-search"></i>
          </button>
        </form>

        <div class="d-flex justify-content-center mt-2">
          <a href="{{ route('productos.vistaCatalogo') }}" class="btn btn-outline-dark btn-sm">
            Ver productos
          </a>
        </div>
      </div>
    </div>

  </div>
</header>

<!-- HERO -->
<section class="position-relative text-white" style="min-height:70vh;">
  <img src="{{ asset('img/unnamed.jpg') }}"
       class="w-100 h-100 position-absolute top-0 start-0"
       style="object-fit:cover; filter:brightness(0.45);">

  <div class="container position-relative h-100 d-flex flex-column justify-content-center">
    <h1 class="display-4 fw-bold">K-SHOP</h1>
    <p class="fs-5 text-light">Moda urbana y estilo contemporáneo</p>

    <a href="{{ route('productos.vistaCatalogo') }}"
       class="btn btn-light text-dark px-5 py-2 rounded-pill mt-3 fw-semibold">
       <i class="bi bi-bag me-2"></i> Explorar colección
    </a>
  </div>
</section>

<!-- NUEVAS TENDENCIAS (CARRUSEL) -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center fw-bold mb-4">NUEVAS TENDENCIAS</h2>

    <div id="carouselTendencias" class="carousel slide">

      <div class="carousel-inner">

        @foreach ($tendencias->chunk(4) as $chunkIndex => $grupo)
        <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
          
          <div class="row g-4">

            @foreach ($grupo as $p)
            <div class="col-6 col-md-4 col-lg-3">

              <div class="card border-0 product-card shadow-sm h-100">

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

            </div>
            @endforeach

          </div>

        </div>
        @endforeach

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselTendencias" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#carouselTendencias" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
      </button>

    </div>

  </div>
</section>

<!-- RECOMENDADOS -->
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
                 Ver producto
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

<!-- NEWSLETTER -->
<section class="py-5 text-center">
  <div class="container">
    <h3 class="fw-bold mb-3">¡Únete a nuestra comunidad K-SHOP!</h3>

    <form action="{{ route('newsletter.store') }}" method="POST" class="row justify-content-center g-2">
      @csrf

      <div class="col-md-4 col-sm-8">
        <input type="email" name="correo" class="form-control form-control-lg" placeholder="Tu correo electrónico">
      </div>

      <div class="col-md-2 col-sm-4 d-flex">
        <button type="submit" class="btn btn-success btn-lg w-100">
          Suscribirme
        </button>
      </div>

    </form>
  </div>
</section>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>