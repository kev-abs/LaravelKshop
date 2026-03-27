@php
    if (session('rol') !== 'cliente') {
        header("Location: " . route('login'));
        exit;
    }
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>K-SHOP | Editar Perfil Cliente</title>

  <!-- Bootstrap y Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- ================= ENCABEZADO ================= -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="83" class="me-2">
      <span class="fw-bold text-dark">K-SHOP | Cliente</span>
    </div>

    <nav>
      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-dark">
              Cerrar sesión
          </button>
      </form>
    </nav>

  </div>
</header>

<!-- ================= CONTENIDO ================= -->
<main class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">

      <div class="card shadow border-0 rounded-4 overflow-hidden">

        <!-- HEADER CARD -->
        <div class="bg-dark text-white text-center py-4">
          <img 
            src="{{ asset('img/perfiles/' . ($cliente->Foto ?? 'default.png')) }}?v={{ time() }}"
            class="rounded-circle border shadow"
            width="140"
            height="140"
            style="object-fit: cover;">

          <h3 class="fw-bold mb-0">{{ $cliente->Nombre }}</h3>
          <p class="mb-1">{{ $cliente->Correo }}</p>

          <span class="badge bg-primary px-3 py-2">
            Cliente
          </span>
        </div>

        <!-- BODY CARD -->
        <div class="card-body p-4">

          <h5 class="fw-bold mb-4">
            <i class="bi bi-person-badge me-2"></i>Información del Cliente
          </h5>

          <form action="{{ route('cliente.perfil.actualizar') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" name="Nombre" class="form-control" value="{{ $cliente->Nombre }}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Correo</label>
              <input type="email" name="Correo" class="form-control" value="{{ $cliente->Correo }}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Documento</label>
              <input type="text" name="Documento" class="form-control" value="{{ $cliente->Documento }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Teléfono</label>
              <input type="text" name="Telefono" class="form-control" value="{{ $cliente->Telefono }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Foto de perfil</label>
              <input type="file" name="foto" class="form-control">
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="{{ route('cliente.perfil') }}" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-dark">Guardar Cambios</button>
            </div>

          </form>

        </div>
      </div>

    </div>
  </div>
</main>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
