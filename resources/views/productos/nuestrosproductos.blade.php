<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Productos - K-Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- ================= ENCABEZADO ================= -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center">
      <a class="navbar-brand fw-bold" href="{{ route('panel.cliente') }}">
        <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="83" class="me-2">
        <span class="fw-bold text-dark">K-SHOP | Cliente</span>
      </a>
    </div>

    <nav>
      <a href="{{ route('logout') }}" class="btn btn-outline-dark border-0">
        Cerrar Sesión
      </a>
    </nav>

  </div>
</header>

<div class="container my-5 flex-grow-1">
    <h2 class="text-center fw-bold mb-5">Nuestros Productos</h2>

    @if(!empty($productos))
    <div class="row g-4">
        @foreach($productos as $p)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm">

                {{-- IMAGEN --}}
                @if(!empty($p['imagen']))
                    <img src="http://localhost:8080/uploads/productos/{{ $p['imagen'] }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;"
                         alt="{{ $p['nombre'] }}">
                @else
                    <img src="{{ asset('img/no-image.png') }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;"
                         alt="Sin imagen">
                @endif

                <div class="card-body text-center d-flex flex-column">
                    <h5 class="fw-bold">{{ $p['nombre'] }}</h5>
                    <p class="text-muted mb-1 small">{{ $p['descripcion'] }}</p>
                    <p class="fw-bold mb-2">${{ number_format($p['precio'], 0, ',', '.') }}</p>

                    {{-- AGREGAR AL CARRITO --}}
                    <form action="{{ route('carrito.store') }}" method="POST" class="mt-auto">
                        @csrf
                        <input type="hidden" name="idProducto" value="{{ $p['id_Producto'] }}">
                        <input type="hidden" name="cantidad" value="1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-cart-plus me-1"></i> Agregar al carrito
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <div class="alert alert-warning text-center">
            No hay productos disponibles
        </div>
    @endif
</div>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <div class="container">
        <div class="mb-3">
            <a href="#" class="text-white me-3">Términos</a>
            <a href="#" class="text-white me-3">Privacidad</a>
            <a href="#" class="text-white">Ayuda</a>
        </div>
        <p class="mb-0">&copy; 2025 Tienda K-Shop</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
