<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP | Panel Cliente</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/panelcliente.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- HEADER -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">

        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="70" class="me-2">
            <span class="fw-bold text-dark">K-SHOP | Cliente</span>
        </div>

        <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex flex-grow-1">
            <input type="text" name="nombre" value="{{ request('nombre') }}"
                   class="form-control me-2"
                   placeholder="Buscar productos...">

            <button class="btn btn-dark">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-dark">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </nav>

    </div>
</header>

<!-- OFFCANVAS -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="menuCliente">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menú Cliente</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="list-unstyled">

            <li class="mb-3">
                <a href="{{ route('cliente.perfil') }}" class="text-white text-decoration-none">
                    <i class="bi bi-person-circle me-2"></i> Mi Perfil
                </a>
            </li>

            <li class="mb-3">
                <a href="{{ route('checkout.historial') }}" class="text-white text-decoration-none">
                    <i class="bi bi-bag-check me-2"></i> Mis Pedidos
                </a>
            </li>

            <li class="mb-3">
                <a href="{{ route('cliente.listaDeseos') }}" class="text-white text-decoration-none">
                    <i class="bi bi-heart me-2"></i> Lista de Deseos
                </a>
            </li>

            <li class="mb-3">
                <a href="{{ route('ventas.carrito.index') }}" class="text-white text-decoration-none">
                    <i class="bi bi-cart me-2"></i> Carrito
                </a>
            </li>

            <li class="mb-3">
                <a href="{{ route('cliente.cupones') }}" class="text-white text-decoration-none">
                    <i class="bi bi-ticket-perforated me-2"></i> Mis Cupones
                </a>
            </li>

            <li class="mb-3">
                <a href="{{ route('cliente.configuracion') }}" class="text-white text-decoration-none">
                    <i class="bi bi-gear me-2"></i> Configuración
                </a>
            </li>

        </ul>
    </div>
</div>

<!-- HERO -->
<section class="hero text-white">

    <img src="{{ asset('img/unnamed.jpg') }}"class="hero-img position-absolute top-0 start-0">

    <div class="menu-float">
        <button class="btn btn-light rounded-pill"
                data-bs-toggle="offcanvas"
                data-bs-target="#menuCliente">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <div class="container position-relative h-100 d-flex flex-column justify-content-center text-center text-md-start">
        <h1 class="display-2 fw-bold">K-SHOP</h1>
        <p class="fs-4">Moda urbana y estilo contemporáneo</p>

        <a href="{{ route('cliente.productos') }}"
           class="btn btn-light text-dark px-4 px-md-5 py-2 rounded-pill mt-3 fw-semibold">
            <i class="bi bi-bag me-2"></i> Explorar colección
        </a>
    </div>
</section>

<!-- CATEGORÍAS -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">CATEGORÍAS</h2>

        <div class="row g-4">
            @foreach ([
                ['nombre'=>'Accesorios', 'icon'=>'bi-watch',   'id'=>3],
                ['nombre'=>'Camisetas',  'icon'=>'bi-person',   'id'=>1],
                ['nombre'=>'Chaquetas',  'icon'=>'bi-cloud',    'id'=>5],
                ['nombre'=>'Pantalones', 'icon'=>'bi-columns',  'id'=>4],
                ['nombre'=>'Calzado',    'icon'=>'bi-shop',     'id'=>2],
            ] as $cat)

            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('cliente.productos', ['categoria' => $cat['id']]) }}" class="text-decoration-none">
                    <div class="category-card text-center p-4 h-100 border rounded">
                        <i class="bi {{ $cat['icon'] }} fs-1 mb-3"></i>
                        <h6 class="fw-bold">{{ $cat['nombre'] }}</h6>
                    </div>
                </a>
            </div>

            @endforeach
        </div>
    </div>
</section>

<!-- MÁS VISTOS -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">MÁS VISTOS</h2>

        <div class="row g-4">
            @foreach ($productos->take(5) as $index => $p)

            <div class="{{ $index == 0 ? 'col-12 col-lg-6' : 'col-6 col-lg-3' }}">
                <div class="position-relative overflow-hidden featured-card">

                    <img src="http://35.175.5.116:8080/uploads/productos/{{ $p->Imagen }}"
                         class="w-100 h-100">

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

<!-- BANNER -->
<section class="py-5 text-white text-center" style="background:black;">
    <div class="container">
        <h2 class="fw-bold">K-SHOP STREETWEAR</h2>
        <p>Colecciones diseñadas para destacar</p>

        <a href="{{ route('cliente.productos') }}"
           class="btn btn-light text-dark rounded-pill px-4">
            <i class="bi bi-arrow-right"></i> Ir al catálogo
        </a>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
    <p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>