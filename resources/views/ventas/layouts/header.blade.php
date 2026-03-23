@php
    $ruta = route('panel.cliente');

    if (request()->routeIs('carrito.confirmar')) {
        $ruta = route('ventas.carrito.index');
    } elseif (request()->routeIs('ventas.carrito.index')) {
        $ruta = route('panel.cliente');
    } elseif (request()->routeIs('pedido.detalle')) {
        $ruta = route('checkout.historial');
    } elseif (request()->routeIs('checkout.historial')) {
        $ruta = route('panel.cliente');
    }
@endphp

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">


        <a class="fw-bold text-dark text-decoration-none d-flex align-items-center" href="{{ $ruta }}">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
            K-SHOP | Cliente
        </a>

        {{-- BUSCADOR --}}
        <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex">
            <input type="text" name="nombre" value="{{ request('nombre') }}" class="form-control me-2"
                placeholder="Buscar productos...">

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
