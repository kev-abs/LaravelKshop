<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Productos - K-Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .text-shadow { text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); }
        .fade-in { opacity: 0; transform: translateY(20px); animation: fadeInUp 0.6s forwards; }
        @keyframes fadeInUp { to { opacity:1; transform: translateY(0); } }
        .btn-hover:hover { transform: translateY(-3px); transition: transform 0.3s; }
        .product-card { transition: transform 0.3s ease, box-shadow 0.3s ease; cursor:pointer; }
        .product-card.zoomed { transform: scale(1.05); z-index:10; box-shadow:0 10px 20px rgba(0,0,0,0.3); position:relative; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- HEADER -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" class="me-2">
            <a href="{{ route('inicio') }}" class="text-decoration-none fs-7 fw-bold text-dark">K-SHOP</a>
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
    
        <nav class="d-flex align-items-center gap-3">
            <a href="{{ route('panel.cliente') }}" class="nav-link text-dark">Panel Cliente</a>
            <a href="#" class="btn btn-outline-dark border-0">
                <i class="bi bi-cart-fill"></i>
            </a>
            @guest
            <a href="{{ route('login') }}" class="btn btn-outline-dark border-0 text-dark">
                <i class="bi bi-person-circle me-1"></i>Iniciar Sesión
            </a>
            @endguest
        </nav>
    </div>
</header>

<!-- MAIN -->
<main class="container my-5">

    <h2 class="text-center mb-4 fw-bold text-shadow">Todos los Productos</h2>

</form>

    <!-- Productos -->
<div class="row g-4">
@forelse($productos as $p)
    <div class="col-md-3">
        <div class="card h-100 shadow-sm">

            @if(!empty(data_get($p,'imagen')))
                <img src="http://localhost:8080/uploads/productos/{{ data_get($p,'imagen') }}"
                     class="card-img-top"
                     alt="{{ data_get($p,'nombre') }}">
            @else
                <div class="bg-light text-center py-5">Sin imagen</div>
            @endif

            <div class="card-body text-center">

                <h5 class="card-title">
                    {{ data_get($p,'nombre') }}
                </h5>

<<<<<<< HEAD
      <div class="img-wrap">
        @if($imagen)
          <img src="http://35.175.5.116:8080/uploads/productos/{{ $imagen }}" alt="{{ $nombre }}">
        @else
          <div class="no-img"><i class="bi bi-image"></i></div>
        @endif
=======
                <p class="card-text text-muted">
                    {{ data_get($p,'descripcion','') }}
                </p>
>>>>>>> parent of 4cb488b (categorizacion cliente)

                <p class="fw-bold">
                    ${{ data_get($p,'precio',0) }}
                </p>

                <p class="mb-2">
                    Stock:
                    @if(data_get($p,'stock',0) <= 0)
                        <span class="text-danger fw-bold">Agotado</span>
                    @else
                        <span class="text-muted">
                            {{ data_get($p,'stock') }}
                        </span>
                    @endif
                </p>

                <a href="{{ route('producto.detalle', data_get($p,'id_Producto')) }}"
                   class="btn btn-outline-dark btn-sm mb-1">
                   Ver Producto
                </a>

                <form action="{{ route('cliente.listaDeseos.agregar') }}"
                      method="POST"
                      class="d-inline">
                    @csrf

                    <input type="hidden"
                           name="ID_Producto"
                           value="{{ data_get($p,'id_Producto') }}">

                    <button type="submit"
                            class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-heart"></i> Añadir a Favoritos
                    </button>
                </form>

            </div>
        </div>
    </div>
@empty
    <p class="text-center text-muted">No hay productos disponibles</p>
@endforelse
</div>

    <div class="text-center my-4">
        <a href="{{ route('panel.cliente') }}" class="btn btn-outline-secondary btn-lg btn-hover">
            <i class="bi bi-arrow-left me-2"></i>Volver al panel
        </a>
    </div>

</main>

<!-- FOOTER -->
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Zoom al click
    const cards = document.querySelectorAll('.product-card');
    cards.forEach(card => {
        card.addEventListener('click', () => {
            cards.forEach(c => c.classList.remove('zoomed'));
            card.classList.add('zoomed');
        });
    });

    document.body.addEventListener('click', e => {
        if (!e.target.closest('.product-card')) {
            cards.forEach(c => c.classList.remove('zoomed'));
        }
    });
</script>
</body>
</html>
