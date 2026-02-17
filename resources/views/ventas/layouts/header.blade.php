<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
      <span class="fw-bold text-dark">K-SHOP | Cliente</span>
    </div>

    <form class="d-none d-md-block w-50">
      <input type="text" class="form-control" placeholder="Buscar productos...">
    </form>

    <a href="{{ route('logout') }}" class="btn btn-outline-dark border-0">
      <i class="bi bi-box-arrow-right"></i> Salir
    </a>
  </div>
</header>
