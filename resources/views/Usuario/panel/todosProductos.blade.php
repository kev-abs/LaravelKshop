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
        <form class="mx-auto d-none d-md-block w-50" action="/buscar" method="GET">
            <input type="text" class="form-control" name="q" placeholder="Buscar en el panel...">
        </form>
        <nav class="d-flex align-items-center gap-3">
            <a href="{{ route('cliente.panel') }}" class="nav-link text-dark">Panel Cliente</a>
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

    <!-- FILTRAR POR CATEGORÍA -->
     <div class="container my-4">
    <!-- Filtro de categorías -->
    <form action="{{ route('cliente.todosProductos') }}" method="GET" class="mb-4">
        <select name="categoria" class="form-select w-50 d-inline">
            <option value="">-- Todas las categorías --</option>
            @foreach($categorias as $c)
                <option value="{{ $c['idCategoria'] }}" 
                    {{ $categoriaId == $c['idCategoria'] ? 'selected' : '' }}>
                    {{ $c['nombre'] }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary ms-2">Filtrar</button>
    </form>

    <!-- Productos -->
    <div class="row g-4">
        @forelse($productos as $p)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    @if(!empty($p['imagen']))
                        <img src="http://localhost/api/uploads/productos/{{ $p['imagen'] }}" 
                             class="card-img-top" alt="{{ $p['nombre'] }}">
                    @else
                        <div class="bg-light text-center py-5">Sin imagen</div>
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $p['nombre'] }}</h5>
                        <p class="card-text text-muted">{{ $p['descripcion'] }}</p>
                        <p class="fw-bold">${{ $p['precio'] }}</p>
                        <a href="#" class="btn btn-outline-primary">Agregar al carrito</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning text-center">
                No hay productos disponibles en esta categoría.
            </div>
        @endforelse
    </div>
</div>





    <div class="text-center my-4">
        <a href="{{ route('cliente.panel') }}" class="btn btn-outline-secondary btn-lg btn-hover">
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
