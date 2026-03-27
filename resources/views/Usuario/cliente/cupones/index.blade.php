<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis Cupones | K-SHOP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap y icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <a class="navbar-brand fw-bold" href="{{ route('panel.cliente') }}">
        <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
        K-SHOP | Cliente
      </a>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-dark">
            Cerrar sesión
        </button>
    </form>
  </div>
</header>

<div class="container my-5 flex-grow-1">

  <!-- TÍTULO -->
  <div class="text-center mb-4">
    <h3 class="fw-bold">
      <i class="bi bi-ticket-perforated text-warning"></i>
      Mis Cupones
    </h3>
    <p class="text-muted">Aquí podrás ver y redimir tus cupones</p>
  </div>

  <!-- CUPONES -->
  <div class="row justify-content-center">
    @forelse ($cupones as $c)
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 @if($c->Usado) opacity-75 @endif">
          <div class="card-body text-center">
            <h5 class="fw-bold">{{ $c->codigo }}</h5>
            <p class="text-muted mb-2">{{ $c->descuento }}% de descuento</p>
            
            @if(!$c->Usado)
              <span class="badge bg-success mb-3 d-inline-block">Disponible</span>
              <form action="{{ route('usuario.cupon.redimir') }}" method="POST">
                  @csrf
                  <input type="hidden" name="ID_Cliente" value="{{ $c->ID_Cliente }}">
                  <input type="hidden" name="ID_Cupon" value="{{ $c->ID_CuponClienteAsignado }}">
                  <button type="submit" class="btn btn-warning btn-sm">Redimir cupón</button>
              </form>
            @else
              <span class="badge bg-secondary">Usado</span>
            @endif

            <p class="text-muted mt-2 mb-0" style="font-size:0.85rem">
              Válido hasta: {{ \Carbon\Carbon::parse($c->fecha_expiracion)->format('d/m/Y') }}
            </p>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center text-muted">No tienes cupones disponibles</p>
    @endforelse
  </div>

  <!-- BOTÓN VOLVER -->
  <div class="text-center mt-4">
    <a href="{{ url()->previous() }}" class="btn btn-outline-dark btn-sm">
      <i class="bi bi-arrow-left"></i> Volver
    </a>
  </div>

</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>