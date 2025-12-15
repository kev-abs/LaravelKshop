{{-- PROTECCIÓN SIMPLE SIN MIDDLEWARE --}}
@php
  if (session('rol') !== 'vendedor') {
      header("Location: " . route('login'));
      exit;
  }
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Perfil Vendedor</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-dark text-white text-center">
          <h5 class="mb-0">Editar Perfil Vendedor</h5>
        </div>

        <div class="card-body p-4">

          <form action="{{ route('vendedor.perfil.actualizar') }}"
                method="POST"
                enctype="multipart/form-data">
            @csrf

            <!-- FOTO ACTUAL -->
            <div class="text-center mb-3">
              <img
                src="{{ asset('img/perfiles/' . ($vendedor->Foto ?? 'foto_perfil_vendedor.png')) }}?v={{ time() }}"
                class="rounded-circle mb-2 border shadow"
                width="120"
                height="120"
                style="object-fit: cover;">
            </div>

            <!-- NOMBRE -->
            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text"
                     name="Nombre"
                     class="form-control"
                     value="{{ $vendedor->Nombre }}"
                     required>
            </div>

            <!-- CORREO -->
            <div class="mb-3">
              <label class="form-label">Correo</label>
              <input type="email"
                     name="Correo"
                     class="form-control"
                     value="{{ $vendedor->Correo }}"
                     required>
            </div>

            <!-- FOTO -->
            <div class="mb-3">
              <label class="form-label">Foto de perfil</label>
              <input type="file"
                     name="foto"
                     class="form-control"
                     accept="image/png, image/jpeg">
              <small class="text-muted">
                JPG o PNG. Máx. 2MB
              </small>
            </div>

            <!-- BOTONES -->
            <div class="d-flex justify-content-between mt-4">
              <a href="{{ route('vendedor.perfil') }}"
                 class="btn btn-secondary">
                Cancelar
              </a>

              <button type="submit"
                      class="btn btn-dark">
                Guardar Cambios
              </button>
            </div>

          </form>

        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>
