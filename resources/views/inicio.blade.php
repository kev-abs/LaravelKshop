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

<!-- ================= HERO ================= -->
<section class="position-relative text-white" style="height:90vh;">
  <img src="{{ asset('img/unnamed.jpg') }}"
       class="w-100 h-100 position-absolute top-0 start-0"
       style="object-fit:cover; filter:brightness(0.45);">

  <div class="container position-relative h-100 d-flex flex-column justify-content-center">
    <h1 class="display-2 fw-bold">K-SHOP</h1>
    <p class="fs-4 text-light">Moda urbana y estilo contemporáneo</p>

    <a href="{{ route('productos.vistaCatalogo') }}"
       class="btn btn-light text-dark px-5 py-2 rounded-pill mt-3 fw-semibold">
       <i class="bi bi-bag me-2"></i> Explorar colección
    </a>
  </div>
</section>

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

<!-- ================= MAS VISTOS (GRANDE) ================= -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-5">MÁS VISTOS</h2>

    <div class="row g-4">

      @foreach ($productos->take(5) as $index => $p)

      <div class="{{ $index == 0 ? 'col-lg-6 col-md-12' : 'col-md-6 col-lg-3' }}">

        <div class="position-relative overflow-hidden featured-card">

          <img src="http://localhost:8080/uploads/productos/{{ $p->Imagen }}"
              class="w-100"
              object-fit:cover;>

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

<!-- ================= CINTA PRO ================= -->
<section class="py-5">
  <div class="container-fluid">
    <h2 class="text-center fw-bold mb-4">NUEVAS TENDENCIAS</h2>

    <div class="scroll-container d-flex gap-4 px-4">

      @foreach ($productos as $p)
      <div class="card border-0 flex-shrink-0 product-card shadow-sm" style="width:260px;">

        <div class="overflow-hidden">
          <img src="http://localhost:8080/uploads/productos/{{ $p->Imagen }}"
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

      @foreach ($productos2 as $p)
      <div class="col-6 col-md-4 col-lg-3">

        <div class="card border-0 product-card h-100">

          <div class="position-relative overflow-hidden">
            <img src="http://localhost:8080/uploads/productos/{{ $p->Imagen }}"
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