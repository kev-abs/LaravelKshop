<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
      <span class="fw-bold text-dark">K-SHOP | Cliente</span>
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
