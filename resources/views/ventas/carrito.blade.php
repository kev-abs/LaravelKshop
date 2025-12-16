<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Carrito - K-Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- NAVBAR -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">

        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="83" class="me-2">
            <a href="{{ route('panel.cliente') }}" class="fw-bold text-dark text-decoration-none">
                K-SHOP | Cliente
            </a>
        </div>

        <nav class="d-flex align-items-center gap-3">
            <a href="{{ route('productos.catalogo') }}" class="nav-link text-dark">
                Productos
            </a>

            <a href="{{ route('ventas.carrito') }}" class="btn btn-outline-dark border-0">
                <i class="bi bi-cart-fill"></i>
            </a>
        </nav>
    </div>
</header>

<!-- CONTENIDO -->
<div class="container my-5 flex-grow-1">
    <h2 class="text-center fw-bold mb-4">Mi Carrito</h2>

    @if(empty($carrito))
        <div class="alert alert-warning text-center">
            Tu carrito está vacío
        </div>
    @else
        <div class="row g-4">
            @foreach($carrito as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">

                        {{-- IMAGEN --}}
                        @if(!empty($item['imagen']))
                            <img src="{{ asset('uploads/productos/' . $item['imagen']) }}"
                                 class="card-img-top"
                                 style="height:200px; object-fit:cover">
                        @else
                            <img src="{{ asset('img/no-image.png') }}"
                                 class="card-img-top"
                                 style="height:200px; object-fit:cover">
                        @endif

                        <div class="card-body text-center">
                            <h5 class="fw-bold">{{ $item['nombre'] }}</h5>

                            <p class="text-muted mb-1">
                                Precio: ${{ number_format($item['precio'], 0, ',', '.') }}
                            </p>

                            <span class="badge bg-primary">
                                Cantidad: {{ $item['cantidad'] }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- VACIAR CARRITO -->
        <form action="{{ route('carrito.vaciar') }}" method="POST" class="text-end mt-4">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">
                <i class="bi bi-trash"></i> Vaciar carrito
            </button>
        </form>

        <form action="{{ route('checkout.index') }}" method="GET" class="text-end mt-3">
            <button class="btn btn-success btn-lg">
                <i class="bi bi-bag-check"></i> Comprar
            </button>
        </form>




    @endif
</div>

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

</body>
</html>
