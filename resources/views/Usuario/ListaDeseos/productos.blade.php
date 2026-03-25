@php
    if (session('rol') !== 'cliente') {
        header("Location: " . route('login'));
        exit;
    }
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>K-SHOP | Productos</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <a class="navbar-brand fw-bold" href="{{ route('panel.cliente') }}">
        <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
      K-SHOP | Cliente
      </a>
    </div>

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

      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-dark">
              Cerrar sesión
          </button>
      </form>
  </div>
</header>

<main class="container my-5">

  <h2 class="fw-bold text-center mb-4">Todos los Productos</h2>

  <div class="row g-4">
    @forelse ($productos as $p)
      <div class="col-6 col-md-4 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
          <img src="http://localhost:8080/uploads/productos/{{ $p->Imagen }}" class="card-img-top" style="height:180px; object-fit:cover">
          <div class="card-body text-center">
            <h6 class="fw-bold">{{ $p->Nombre }}</h6>
            <p class="text-muted mb-1">Precio: $ {{ number_format($p->Precio, 0, ',', '.') }}</p>
            <p class="text-muted mb-2">Stock: {{ $p->Stock ?? 'Disponible' }}</p>

<<<<<<< HEAD
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
  .product-card .btn-fav.active {
    border-color: #e74c3c;
    color: #e74c3c;
    background: #fff5f5;
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
  .product-card:hover .img-wrap img { transform: scale(1.07); }
  .product-card .img-wrap .no-img {
    display: flex; align-items: center; justify-content: center;
    height: 100%; color: #ccc; font-size: 2.5rem;
  }
  .product-card .stock-badge {
    position: absolute; top: 12px; right: 12px;
    border-radius: 999px; padding: 4px 10px;
    font-size: 0.72rem; font-weight: 600;
  }
  .product-card .card-body { padding: 1.1rem 1.2rem 1.3rem; }
  .product-card .card-title {
    font-size: 0.95rem; font-weight: 700; color: #1a1a1a;
    margin-bottom: 4px; white-space: nowrap;
    overflow: hidden; text-overflow: ellipsis;
  }
  .product-card .price {
    font-size: 1.15rem; font-weight: 800;
    color: #212529; margin-bottom: 14px;
  }
  .product-card .actions { display: flex; gap: 8px; }
  .product-card .btn-ver {
    flex: 1; background: #212529; color: #fff;
    border: none; border-radius: 10px; padding: 8px 0;
    font-size: 0.8rem; font-weight: 600;
    transition: background 0.2s, transform 0.2s;
    text-decoration: none; display: flex;
    align-items: center; justify-content: center; gap: 5px;
  }
  .product-card .btn-ver:hover {
    background: #3a3a3a; transform: translateY(-1px); color: #fff;
  }
  .product-card .btn-fav {
    width: 38px; height: 38px; border-radius: 10px;
    border: 1.5px solid #f0f0f0; background: #fff; color: #ccc;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; transition: all 0.2s; cursor: pointer; flex-shrink: 0;
  }
  .product-card .btn-fav:hover { border-color: #e74c3c; color: #e74c3c; transform: scale(1.1); }
  .product-card .btn-fav.active { border-color: #e74c3c; color: #e74c3c; background: #fff5f5; }
  @keyframes cardIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .row .col-6:nth-child(1) .product-card { animation-delay: 0.05s; }
  .row .col-6:nth-child(2) .product-card { animation-delay: 0.10s; }
  .row .col-6:nth-child(3) .product-card { animation-delay: 0.15s; }
  .row .col-6:nth-child(4) .product-card { animation-delay: 0.20s; }
  .row .col-6:nth-child(5) .product-card { animation-delay: 0.25s; }
  .row .col-6:nth-child(6) .product-card { animation-delay: 0.30s; }
  .row .col-6:nth-child(7) .product-card { animation-delay: 0.35s; }
  .row .col-6:nth-child(8) .product-card { animation-delay: 0.40s; }
</style>

<div class="row g-4">
  @forelse ($productos as $p)
    @php $esFavorito = in_array($p->ID_Producto, $favoritos ?? []); @endphp
    <div class="col-6 col-md-4 col-lg-3">
      <div class="product-card shadow-sm">

        <div class="img-wrap">
          @if($p->Imagen)
            <img src="http://35.175.5.116:8080/uploads/productos/{{ $p->Imagen }}" alt="{{ $p->Nombre }}">
          @else
            <div class="no-img"><i class="bi bi-image"></i></div>
          @endif

          @if($p->Stock <= 0)
            <span class="stock-badge bg-danger text-white">Agotado</span>
          @elseif($p->Stock <= 5)
            <span class="stock-badge bg-warning text-dark">Últimas {{ $p->Stock }}</span>
          @endif
        </div>

        <div class="card-body">
          <div class="card-title">{{ $p->Nombre }}</div>
          <div class="price">${{ number_format($p->Precio, 0, ',', '.') }}</div>

          <div class="actions">
            <a href="{{ route('producto.detalle', $p->ID_Producto) }}" class="btn-ver">
              <i class="bi bi-eye"></i> Ver
            </a>

            <form action="{{ route('cliente.listaDeseos.agregar') }}" method="POST">
=======
            <a href="{{ route('producto.detalle', $p->ID_Producto) }}"
   class="btn btn-outline-dark btn-sm mb-1">
   Ver Producto
</a>
            <form action="{{ route('cliente.listaDeseos.agregar') }}" method="POST" class="d-inline">
>>>>>>> parent of 4cb488b (categorizacion cliente)
              @csrf
              <input type="hidden" name="ID_Producto" value="{{ $p->ID_Producto }}">
              <button type="submit" class="btn btn-outline-danger btn-sm">
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

</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 K-SHOP - Panel Cliente</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
