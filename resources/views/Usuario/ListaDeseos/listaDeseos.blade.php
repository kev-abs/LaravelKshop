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
  <title>K-SHOP | Lista de Deseos</title>
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
        <a href="{{ route('cliente.listaDeseos') }}" class="text-white text-decoration-none">
          <i class="bi bi-heart me-2"></i> Lista de Deseos
        </a>
      </li>
      <li class="mb-3">
        <a href="#" class="text-white text-decoration-none">
          <i class="bi bi-cart me-2"></i> Carrito
        </a>
      </li>
    </ul>
  </div>
</div>

<div class="ps-3 py-2">
  <button class="btn btn-light shadow-sm rounded-4" data-bs-toggle="offcanvas" data-bs-target="#menuCliente">
    <i class="bi bi-list fs-4"></i> Menú
  </button>
</div>

<main class="container my-5">
  <h3 class="fw-bold text-center mb-4">Mi Lista de Deseos</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <style>
  .wish-card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    transition: transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s cubic-bezier(.4,0,.2,1);
    background: #fff;
    animation: cardIn 0.5s cubic-bezier(.4,0,.2,1) both;
  }
  .wish-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
  }
  .wish-card .img-wrap {
    position: relative;
    overflow: hidden;
    height: 220px;
    background: #f8f8f8;
  }
  .wish-card .img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(.4,0,.2,1);
  }
  .wish-card:hover .img-wrap img { transform: scale(1.07); }
  .wish-card .card-body { padding: 1.1rem 1.2rem 1.3rem; }
  .wish-card .card-title {
    font-size: 0.95rem; font-weight: 700; color: #1a1a1a;
    margin-bottom: 4px; white-space: nowrap;
    overflow: hidden; text-overflow: ellipsis;
  }
  .wish-card .price {
    font-size: 1.15rem; font-weight: 800;
    color: #212529; margin-bottom: 14px;
  }
  .wish-card .actions { display: flex; gap: 8px; }
  .wish-card .btn-carrito {
    flex: 1; background: #212529; color: #fff;
    border: none; border-radius: 10px; padding: 8px 0;
    font-size: 0.8rem; font-weight: 600;
    transition: background 0.2s, transform 0.2s;
    display: flex; align-items: center;
    justify-content: center; gap: 5px; cursor: pointer;
  }
  .wish-card .btn-carrito:hover {
    background: #3a3a3a; transform: translateY(-1px);
  }
  .wish-card .btn-eliminar {
    width: 38px; height: 38px; border-radius: 10px;
    border: 1.5px solid #fde8e8; background: #fff5f5;
    color: #e74c3c; display: flex; align-items: center;
    justify-content: center; font-size: 1rem;
    transition: all 0.2s; cursor: pointer; flex-shrink: 0;
  }
  .wish-card .btn-eliminar:hover {
    background: #e74c3c; color: #fff; transform: scale(1.1);
  }
  @keyframes cardIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .row .col:nth-child(1) .wish-card { animation-delay: 0.05s; }
  .row .col:nth-child(2) .wish-card { animation-delay: 0.10s; }
  .row .col:nth-child(3) .wish-card { animation-delay: 0.15s; }
  .row .col:nth-child(4) .wish-card { animation-delay: 0.20s; }
  .row .col:nth-child(5) .wish-card { animation-delay: 0.25s; }
  .row .col:nth-child(6) .wish-card { animation-delay: 0.30s; }
  .row .col:nth-child(7) .wish-card { animation-delay: 0.35s; }
  .row .col:nth-child(8) .wish-card { animation-delay: 0.40s; }
</style>

@if(count($deseos) > 0)
  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
    @foreach($deseos as $d)
      <div class="col">
        <div class="wish-card shadow-sm">

          <div class="img-wrap">
            @if($d->Imagen)
              <img src="http://localhost:8080/uploads/productos/{{ $d->Imagen }}" alt="{{ $d->Nombre }}">
            @else
              <div style="display:flex;align-items:center;justify-content:center;height:100%;color:#ccc;font-size:2.5rem;">
                <i class="bi bi-image"></i>
              </div>
            @endif
          </div>

          <div class="card-body">
            <div class="card-title">{{ $d->Nombre }}</div>
            <div class="price">${{ number_format($d->Precio ?? 0, 0, ',', '.') }}</div>

            <div class="actions">
              {{-- Botón añadir al carrito --}}
              <button class="btn-carrito">
                <i class="bi bi-cart-plus"></i> Añadir al carrito
              </button>

              {{-- Botón eliminar de favoritos --}}
              <form action="{{ route('cliente.listaDeseos.eliminar', $d->ID_Lista) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-eliminar" title="Eliminar de favoritos">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </div>
          </div>

        </div>
      </div>
    @endforeach
  </div>

@else
  <div class="text-center py-5 text-muted">
    <i class="bi bi-heart fs-1 d-block mb-3"></i>
    No tienes productos en tu lista de deseos.
  </div>
@endif
</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 K-SHOP - Panel Cliente</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
