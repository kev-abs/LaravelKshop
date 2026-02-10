<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Detalle Producto - KShop</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

</head>

<body class="d-flex flex-column min-vh-100">

<!-- HEADER -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
<div class="container d-flex justify-content-between align-items-center">

<a class="navbar-brand fw-bold" href="{{ route('panel.cliente') }}">
<img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="83">
K-SHOP | Cliente
</a>

<a href="{{ route('logout') }}" class="btn btn-outline-dark border-0">
Cerrar sesión
</a>

</div>
</header>

<!-- CONTENIDO -->
<div class="container my-5 flex-grow-1">

@if(isset($producto) && $producto)

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow border-0">

<div class="row g-0">

{{-- IMAGEN --}}
<div class="col-md-6">

@if(!empty($producto['imagen']))
                    <img src="http://localhost:8080/uploads/productos/{{ $producto['imagen'] }}"
                         class="card-img-top"
                         style="height:300px; object-fit:cover;"
                         alt="{{ $producto['nombre'] }}">
                @else
                    <img src="{{ asset('img/no-image.png') }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;"
                         alt="Sin imagen">
                @endif

</div>

{{-- INFO --}}
<div class="col-md-6">

<div class="card-body d-flex flex-column h-100">

<h4 class="fw-bold">{{ $producto['nombre'] }}</h4>

<p class="text-muted small">
{{ $producto['descripcion'] }}
</p>

<h5 class="fw-bold mt-2">
$ {{ number_format($producto['precio'],0,',','.') }}
</h5>

<form action="{{ route('carrito.store') }}" method="POST" class="mt-auto">
                        @csrf
                        <input type="hidden" name="idProducto" value="{{ $producto['id_Producto'] }}">
                        <input type="hidden" name="cantidad" value="1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-cart-plus me-1"></i> Agregar al carrito
                        </button>
                    </form>

</div>

</div>

</div>

</div>

</div>

</div>

@else

<div class="alert alert-warning text-center">
Producto no encontrado
</div>

@endif

</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">© 2025 K-SHOP</p>
</footer>

</body>
</html>
