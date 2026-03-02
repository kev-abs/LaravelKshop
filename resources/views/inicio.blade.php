<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio - KSHOP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('css/iniciostyle.css') }}" rel="stylesheet">
</head>
<body>

<!-- HEADER -->
<header class="bg-white shadow-sm sticky-top border-bottom py-3">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="70" alt="K-SHOP" class="me-2">
      <a href="/" class="fw-bold text-dark fs-4 text-decoration-none">K-SHOP</a>
    </div>

    <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex">
      <input type="text" name="nombre" class="form-control me-2" placeholder="Buscar productos...">
      <button class="btn btn-dark"><i class="bi bi-search"></i></button>
    </form>

    <nav class="d-flex align-items-center gap-3">
      <a href="{{ route('productos.vistaCatalogo') }}" class="nav-link text-dark">Productos</a>
      <a href="{{ route('login') }}" class="btn btn-outline-dark border-0"><i class="bi bi-person-circle me-1"></i>Iniciar sesión</a>
    </nav>
  </div>
</header>

<!-- ====================== CARRUSEL ====================== -->
<div id="carouselKshop" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselKshop" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carouselKshop" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carouselKshop" data-bs-slide-to="2"></button>
  </div>

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
      ] as $cat)
      <div class="col-md-4">
        <div class="category-card shadow-sm">
          <a href="{{ route('productos.vistaCatalogo') }}">
            <img src="{{ asset($cat['img']) }}" alt="{{ $cat['titulo'] }}">
            <div class="category-overlay">
              <h4>{{ $cat['titulo'] }}</h4>
            </div>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ================== PRODUCTOS DESTACADOS ====================== -->
<section class="py-5">
  <div class="container">
    <h2 class="fw-bold text-center mb-5 text-uppercase">Lo más nuevo</h2>

    @if(isset($productosDestacados) && $productosDestacados->isNotEmpty())
    <div class="row g-4 justify-content-center">
      @foreach ($productosDestacados as $p)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm border-0 text-center">

            {{-- IMAGEN --}}
            @if(!empty($p->Imagen))
              <a href="{{ route('producto.detalle', $p->ID_Producto) }}">
                <img src="http://localhost:8080/uploads/productos/{{ $p->Imagen }}"
                    class="card-img-top"
                    style="height:230px; object-fit:cover;"
                    alt="{{ $p->Nombre }}">
              </a>
            @else
              <img src="{{ asset('img/no-image.png') }}"
                  class="card-img-top"
                  style="height:230px; object-fit:cover;"
                  alt="Sin imagen">
            @endif

            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <h6 class="fw-bold">{{ $p->Nombre }}</h6>

                <p class="text-muted small">
                  {{ $p->Descripcion ?? 'Sin descripción disponible' }}
                </p>

                <p class="fw-bold mb-1">
                  ${{ number_format($p->Precio, 0, ',', '.') }}
                </p>

                @if($p->Stock <= 0)
                  <span class="text-danger fw-bold small">Agotado</span>
                @else
                  <span class="text-success fw-semibold small">
                    Stock: {{ $p->Stock }}
                  </span>
                @endif
              </div>

              <div class="mt-3">
                <a href="{{ route('producto.detalle', $p->ID_Producto) }}"
                  class="btn btn-dark btn-sm rounded-pill w-100">
                  <i class="bi bi-eye me-1"></i> Ver producto
                </a>
              </div>
            </div>

          </div>
        </div>
        @endforeach
    </div>
    @else
      <p class="text-center text-muted">No hay productos destacados aún.</p>
    @endif

  </div>
</section>
<!-- ====================== NEWSLETTER ====================== -->
<section class="newsletter py-5 text-center">
  <div class="container">
    <h3 class="fw-bold mb-3">¡Únete a nuestra comunidad K-SHOP!</h3>
    <p class="text-secondary mb-4">Recibe descuentos exclusivos y las últimas tendencias directamente en tu correo</p>
    <form class="row justify-content-center g-2">
      <div class="col-md-4 col-sm-8">
        <input type="email" class="form-control form-control-lg" placeholder="Tu correo electrónico">
      </div>
      <div class="col-md-2 col-sm-4">
        <button type="submit" class="btn btn-warning btn-lg fw-semibold w-100 text-dark">Suscribirme</button>
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
          <li><a href="#" class="text-white text-decoration-none">Preguntas frecuentes</a></li>
          <li><a href="#" class="text-white text-decoration-none">Política de devoluciones</a></li>
          <li><a href="#" class="text-white text-decoration-none">Contáctanos</a></li>
          <li><a href="#" class="text-white text-decoration-none">Sobre nosotros</a></li>
        </ul>
      </div>

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
      &copy; 2026 K-SHOP | Todos los derechos reservados
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>