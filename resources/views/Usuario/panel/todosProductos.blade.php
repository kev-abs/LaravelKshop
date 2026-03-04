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
    {{-- MENÚ DESPLEGABLE DE CATEGORÍAS --}}
<style>
  .cat-dropdown {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
  }
  .cat-dropdown .dropdown-toggle {
    border-radius: 999px;
    padding: 10px 24px;
    background: #fff;
    border: 1.5px solid #dee2e6;
    color: #333;
    font-size: 0.88rem;
    font-weight: 500;
    transition: all 0.2s;
  }
  .cat-dropdown .dropdown-toggle.active-cat {
    border-color: #212529;
    background: #212529;
    color: #fff;
  }
  .cat-dropdown .dropdown-menu {
    border-radius: 14px;
    border: none;
    background: #fff !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    padding: 8px;
    min-width: 200px;
  }
  .cat-dropdown .dropdown-item {
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 0.85rem;
    color: #333 !important;
    background: transparent !important;
    transition: all 0.15s;
  }
  .cat-dropdown .dropdown-item:hover {
    background: #f5f5f5 !important;
    color: #212529 !important;
  }
  .cat-dropdown .dropdown-item.selected-cat {
    background: #212529 !important;
    color: #fff !important;
  }
</style>
@if(!empty($categorias))
<div class="cat-dropdown">
  <div class="dropdown">
    <button class="btn dropdown-toggle {{ !empty($categoriaId) ? 'active-cat' : '' }}"
            type="button" data-bs-toggle="dropdown">
      <i class="bi bi-tags me-2"></i>
      Todas las categorías
    </button>
    <ul class="dropdown-menu">
      <li>
        <a class="dropdown-item {{ empty($categoriaId) ? 'selected-cat' : '' }}"
           href="{{ route('cliente.productos', array_filter(['genero' => $genero ?? null])) }}">
          <i class="bi bi-grid me-2"></i> Todas
        </a>
      </li>
      <li><hr class="dropdown-divider mx-2"></li>
      @foreach($categorias as $cat)
      @php
        $catId  = $cat->idCategoria ?? null;
        $catNom = $cat->nombre ?? '';
      @endphp
      <li>
        <a class="dropdown-item {{ !empty($categoriaId) && (string)$categoriaId === (string)$catId ? 'selected-cat' : '' }}"
           href="{{ route('cliente.productos', array_filter(['categoria' => $catId, 'genero' => $genero ?? null])) }}">
          {{ $catNom }}
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</div>
@endif
{{-- FILTROS DE GÉNERO --}}
<style>
  .gender-filters {
    display: flex;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
    margin: 0 auto 2.5rem;
    padding: 6px;
    background: #f5f5f5;
    border-radius: 999px;
    width: fit-content;
  }

  .gender-btn {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 10px 22px;
    border-radius: 999px;
    border: none;
    background: transparent;
    color: #555;
    font-size: 0.88rem;
    font-weight: 500;
    letter-spacing: 0.3px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(.4,0,.2,1);
    position: relative;
    overflow: hidden;
  }

  .gender-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: #212529;
    border-radius: 999px;
    transform: scale(0.6);
    opacity: 0;
    transition: all 0.25s cubic-bezier(.4,0,.2,1);
  }

  .gender-btn:hover::before {
    transform: scale(1);
    opacity: 0.08;
  }

  .gender-btn span, .gender-btn i {
    position: relative;
    z-index: 1;
  }

  .gender-btn.active {
    background: #212529;
    color: #fff;
    box-shadow: 0 4px 14px rgba(0,0,0,0.18);
    transform: translateY(-1px);
  }

  .gender-btn.active::before { display: none; }

  .gender-btn:hover:not(.active) {
    color: #212529;
    transform: translateY(-1px);
  }

  /* Entrada animada */
  .gender-filters .gender-btn {
    animation: filterIn 0.4s cubic-bezier(.4,0,.2,1) both;
  }
  .gender-filters .gender-btn:nth-child(1) { animation-delay: 0.05s; }
  .gender-filters .gender-btn:nth-child(2) { animation-delay: 0.12s; }
  .gender-filters .gender-btn:nth-child(3) { animation-delay: 0.19s; }
  .gender-filters .gender-btn:nth-child(4) { animation-delay: 0.26s; }

  @keyframes filterIn {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
  }
</style>

<div class="gender-filters">

  <a href="{{ route('cliente.productos') }}"
     class="gender-btn {{ is_null($genero ?? null) ? 'active' : '' }}">
    <i class="bi bi-grid-3x3-gap"></i>
    <span>Todos</span>
  </a>

  <a href="{{ route('cliente.productos', ['genero' => 'hombre']) }}"
     class="gender-btn {{ ($genero ?? null) === 'hombre' ? 'active' : '' }}">
    <i class="bi bi-gender-male"></i>
    <span>Hombre</span>
  </a>

  <a href="{{ route('cliente.productos', ['genero' => 'mujer']) }}"
     class="gender-btn {{ ($genero ?? null) === 'mujer' ? 'active' : '' }}">
    <i class="bi bi-gender-female"></i>
    <span>Mujer</span>
  </a>

  <a href="{{ route('cliente.productos', ['genero' => 'accesorios']) }}"
     class="gender-btn {{ ($genero ?? null) === 'accesorios' ? 'active' : '' }}">
    <i class="bi bi-bag"></i>
    <span>Accesorios</span>
  </a>

</div>

  <style>
  .product-card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    transition: transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s cubic-bezier(.4,0,.2,1);
    background: #fff;
    animation: cardIn 0.5s cubic-bezier(.4,0,.2,1) both;
  }

  .product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
  }

  .product-card .img-wrap {
    position: relative;
    overflow: hidden;
    height: 220px;
    background: #f8f8f8;
  }

  .product-card .img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(.4,0,.2,1);
  }

  .product-card:hover .img-wrap img {
    transform: scale(1.07);
  }

  .product-card .img-wrap .no-img {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #ccc;
    font-size: 2.5rem;
  }

  .product-card .badge-genero {
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(4px);
    border-radius: 999px;
    padding: 4px 10px;
    font-size: 0.72rem;
    font-weight: 600;
    color: #333;
    letter-spacing: 0.3px;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .product-card .stock-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    border-radius: 999px;
    padding: 4px 10px;
    font-size: 0.72rem;
    font-weight: 600;
  }

  .product-card .card-body {
    padding: 1.1rem 1.2rem 1.3rem;
  }

  .product-card .card-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .product-card .card-desc {
    font-size: 0.78rem;
    color: #999;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .product-card .price {
    font-size: 1.15rem;
    font-weight: 800;
    color: #212529;
    margin-bottom: 14px;
  }

  .product-card .actions {
    display: flex;
    gap: 8px;
  }

  .product-card .btn-ver {
    flex: 1;
    background: #212529;
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 8px 0;
    font-size: 0.8rem;
    font-weight: 600;
    transition: background 0.2s, transform 0.2s;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
  }

  .product-card .btn-ver:hover {
    background: #3a3a3a;
    transform: translateY(-1px);
    color: #fff;
  }

  .product-card .btn-fav {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    border: 1.5px solid #f0f0f0;
    background: #fff;
    color: #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    transition: all 0.2s;
    cursor: pointer;
    flex-shrink: 0;
  }

  .product-card .btn-fav:hover {
    border-color: #e74c3c;
    color: #e74c3c;
    transform: scale(1.1);
  }

  /* Entrada escalonada */
  @keyframes cardIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }

.cat-dropdown .dropdown-item {
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 0.85rem;
    color: #333;
    transition: all 0.15s;
  }
  .cat-dropdown .dropdown-item:hover {
    background: #f5f5f5;
    color: #212529;
  }
  .cat-dropdown .dropdown-item.active {
    background: #212529;
    color: #fff;
  }
  .cat-dropdown {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
  }
  .cat-dropdown .dropdown-toggle {
    border-radius: 999px;
    padding: 10px 24px;
    background: #fff;
    border: 1.5px solid #dee2e6;
    color: #333;
    font-size: 0.88rem;
    font-weight: 500;
    transition: all 0.2s;
  }
  .cat-dropdown .dropdown-toggle.active-cat {
    border-color: #212529;
    background: #212529;
    color: #fff;
  }
  .cat-dropdown .dropdown-menu {
    border-radius: 14px;
    border: none;
    background: #fff !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    padding: 8px;
    min-width: 200px;
  }
  .cat-dropdown .dropdown-item {
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 0.85rem;
    color: #333 !important;
    background: transparent !important;
    transition: all 0.15s;
  }
  .cat-dropdown .dropdown-item:hover {
    background: #f5f5f5 !important;
    color: #212529 !important;
  }
  .cat-dropdown .dropdown-item.selected-cat {
    background: #212529 !important;
    color: #fff !important;
  }
</style>

<div class="row g-4">
@forelse($productos as $p)
  @php
    $idProducto = data_get($p,'id_Producto') ?? data_get($p,'ID_Producto');
    $imagen     = data_get($p,'imagen')      ?? data_get($p,'Imagen');
    $nombre     = data_get($p,'nombre')      ?? data_get($p,'Nombre')      ?? '';
    $descripcion= data_get($p,'descripcion') ?? data_get($p,'Descripcion') ?? '';
    $precio     = data_get($p,'precio')      ?? data_get($p,'Precio')      ?? 0;
    $stock      = data_get($p,'stock')       ?? data_get($p,'Stock')       ?? 0;
    $generoP    = strtolower(data_get($p,'genero') ?? data_get($p,'Genero') ?? '');


    $generoIcono = [
      'hombre'     => ['bi-gender-male',    '♂'],
      'mujer'      => ['bi-gender-female',   '♀'],
      'accesorios' => ['bi-bag',             '🛍'],
      'unisex'     => ['bi-gender-ambiguous','~'],
    ][$generoP] ?? null;
  @endphp

  <div class="col-6 col-md-4 col-lg-3">
    <div class="product-card shadow-sm">

      <div class="img-wrap">
        @if($imagen)
          <img src="http://localhost:8080/uploads/productos/{{ $imagen }}" alt="{{ $nombre }}">
        @else
          <div class="no-img"><i class="bi bi-image"></i></div>
        @endif

        @if($generoIcono)
        <span class="badge-genero">
          <i class="bi {{ $generoIcono[0] }}"></i> {{ ucfirst($generoP) }}
        </span>
        @endif

        @if($stock <= 0)
          <span class="stock-badge bg-danger text-white">Agotado</span>
        @elseif($stock <= 5)
          <span class="stock-badge bg-warning text-dark">Últimas {{ $stock }}</span>
        @endif
      </div>

      <div class="card-body">
        <div class="card-title">{{ $nombre }}</div>
        <div class="card-desc">{{ $descripcion }}</div>
        <div class="price">${{ number_format($precio, 0, ',', '.') }}</div>

        <div class="actions">
          <a href="{{ route('producto.detalle', $idProducto) }}" class="btn-ver">
            <i class="bi bi-eye"></i> Ver
          </a>

          <form action="{{ route('cliente.listaDeseos.agregar') }}" method="POST">
            @csrf
            <input type="hidden" name="ID_Producto" value="{{ $idProducto }}">
            @php $esFavorito = in_array($idProducto, $favoritos ?? []); @endphp
<button type="submit" class="btn-fav {{ $esFavorito ? 'active' : '' }}" title="Añadir a favoritos">
    <i class="bi {{ $esFavorito ? 'bi-heart-fill' : 'bi-heart' }}"></i>
</button>
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
@empty
  <div class="col-12 text-center py-5 text-muted">
    <i class="bi bi-box-open fs-1 d-block mb-3"></i>
    No hay productos disponibles
  </div>
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
