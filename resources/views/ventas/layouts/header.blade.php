@if (
    request()->routeIs('ventas.carrito.index') || 
    request()->routeIs('carrito.confirmar')
)

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">

    {{-- LOGO DINÁMICO --}}
    <a class="navbar-brand fw-bold" 
       href="
       @if(request()->routeIs('pedido.detalle'))
           {{ route('checkout.historial') }}
       @elseif(request()->routeIs('checkout.historial'))
           {{ route('panel.cliente') }}
       @else
           {{ route('panel.cliente') }}
       @endif
       ">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="83">
      K-SHOP | Cliente
    </a>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-outline-dark">
        Cerrar sesión
      </button>
    </form>

  </div>
</header>

@else

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">

    {{-- LOGO DINÁMICO --}}
    <div class="d-flex align-items-center">
      <a class="fw-bold text-dark text-decoration-none"
         href="
         @if(request()->routeIs('pedido.detalle'))
             {{ route('checkout.historial') }}
         @elseif(request()->routeIs('checkout.historial'))
             {{ route('panel.cliente') }}
         @else
             {{ route('panel.cliente') }}
         @endif
         ">
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

@endif