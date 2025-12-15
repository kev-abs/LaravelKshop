@php
    if (session('rol') !== 'vendedor') {
        header("Location: " . route('login'));
        exit;
    }
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>K-SHOP | Perfil Vendedor</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- ================= ENCABEZADO ================= -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center">
      <a class="navbar-brand fw-bold" href="{{ route('panel.vendedor') }}">
        <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="83" class="me-2">
        <span class="fw-bold text-dark">K-SHOP | Vendedor</span>
      </a>
    </div>

    <nav>
      <a href="{{ route('logout') }}" class="btn btn-outline-dark border-0">
        Cerrar Sesión
      </a>
    </nav>

  </div>
</header>

<!-- ================= CONTENIDO ================= -->
<main class="container my-5">

  <div class="row justify-content-center">
    <div class="col-lg-8">

      <!-- CARD PERFIL -->
      <div class="card shadow border-0 rounded-4 overflow-hidden">

        <!-- HEADER CARD -->
        <div class="bg-dark text-white text-center py-4">
          <img 
            src="{{ asset('img/perfiles/' . ($vendedor->Foto ?? 'default.png')) }}?v={{ time() }}"
            class="rounded-circle border shadow"
            width="140"
            height="140"
            style="object-fit: cover;">

          <h3 class="fw-bold mb-0">{{ $vendedor->Nombre }}</h3>
          <p class="mb-1">{{ $vendedor->Correo }}</p>

          <span class="badge bg-success px-3 py-2">
            {{ $vendedor->Cargo }}
          </span>
        </div>

        <!-- BODY CARD -->
        <div class="card-body p-4">

          <h5 class="fw-bold mb-4">
            <i class="bi bi-person-badge me-2"></i>Información del Vendedor
          </h5>

          <div class="row g-3">

            <div class="col-md-6">
              <div class="border rounded-3 p-3 bg-light">
                <strong>ID Empleado</strong>
                <p class="mb-0 text-muted">{{ $vendedor->ID_Empleado }}</p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="border rounded-3 p-3 bg-light">
                <strong>Estado</strong><br>
                @if($vendedor->Estado === 'Activo')
                  <span class="badge bg-success">Activo</span>
                @else
                  <span class="badge bg-secondary">{{ $vendedor->Estado }}</span>
                @endif
              </div>
            </div>

            <div class="col-md-6">
              <div class="border rounded-3 p-3 bg-light">
                <strong>Fecha de Contratación</strong>
                <p class="mb-0 text-muted">{{ $vendedor->Fecha_Contratacion }}</p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="border rounded-3 p-3 bg-light">
                <strong>Rol del Sistema</strong>
                <p class="mb-0 text-muted">Vendedor</p>
              </div>
            </div>

          </div>

          <!-- BOTONES -->
          <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('vendedor.perfil.editar') }}"
               class="btn btn-outline-dark">
              <i class="bi bi-pencil-square me-1"></i> Editar Perfil
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>

</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
