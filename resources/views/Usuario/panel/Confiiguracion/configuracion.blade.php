@php
  if (session('rol') !== 'administrador') {
      header("Location: " . route('login'));
      exit;
  }
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>K-SHOP - Panel Admin</title>

  <!-- Bootstrap y Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body class="d-flex flex-column min-vh-100">

<!-- ENCABEZADO PANEL ADMIN -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">

    <!-- LOGO -->
    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" class="me-2">
      <a href="{{route('panel.admin')}}" class="text-decoration-none fs-7 fw-bold text-dark">K-SHOP | Admin</a>
    </div>

    <!-- BARRA DE BÚSQUEDA -->
    <form class="mx-auto d-none d-md-block w-50" action="/buscar" method="GET">
      <input type="text" class="form-control" name="q" placeholder="Buscar en el panel...">
    </form>

    <!-- BOTÓN CERRAR SESIÓN -->
    <nav class="d-flex align-items-center gap-3">
      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-dark">
              Cerrar sesión
          </button>
      </form>
    </nav>
  </div>
</header>

<body class="bg-light">

<body class="bg-light" id="body">

<div class="container-fluid mt-4">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h5><i class="bi bi-gear"></i> Configuración</h5>

                    <div class="list-group">
                        <button class="list-group-item list-group-item-action active opcion" data-target="perfil">
                            <i class="bi bi-person"></i> Perfil
                        </button>

                        <button class="list-group-item list-group-item-action opcion" data-target="seguridad">
                            <i class="bi bi-shield-lock"></i> Seguridad
                        </button>

                        <button class="list-group-item list-group-item-action opcion" data-target="privacidad">
                            <i class="bi bi-lock"></i> Privacidad
                        </button>

                        <button class="list-group-item list-group-item-action opcion" data-target="modo">
                            <i class="bi bi-moon"></i> Modo oscuro
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- CONTENIDO -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-body">

                    <!-- PERFIL -->
                    <div class="contenido" id="perfil">

                        <div class="text-center bg-dark text-white p-4 rounded mb-4">
                            <img src="{{ asset('img/perfiles/' . ($admin->Foto ?? 'default.png')) }}"class="rounded-circle mb-2"width="120" height="120">

                            <h4>{{ $admin->Nombre }}</h4>
                            <small>{{ $admin->Correo }}</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>ID:</strong> {{ $admin->ID_Empleado }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Estado:</strong> {{ $admin->Estado }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Fecha:</strong> {{ $admin->Fecha_Contratacion }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Rol:</strong> Administrador
                            </div>
                        </div>
                    </div>

                    <!-- SEGURIDAD -->
                    <div class="contenido d-none" id="seguridad">

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('empleado.cambiar.password') }}">
                            @csrf

                            <input type="password" name="actual" class="form-control mb-2" placeholder="Actual">
                            <input type="password" name="nueva" class="form-control mb-2" placeholder="Nueva">
                            <input type="password" name="confirmar" class="form-control mb-2" placeholder="Confirmar">

                            <button class="btn btn-success">Actualizar contraseña</button>
                        </form>
                    </div>

                    <!-- PRIVACIDAD -->
                    <div class="contenido d-none" id="privacidad">

                        <h5>Datos visibles</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Nombre: {{ $admin->Nombre }}</li>
                            <li class="list-group-item">Correo: {{ $admin->Correo }}</li>
                            <li class="list-group-item">Cargo: {{ $admin->Cargo }}</li>
                            <li class="list-group-item">Estado: {{ $admin->Estado }}</li>
                        </ul>

                    </div>

                    <!-- MODO OSCURO -->
                    <div class="contenido d-none" id="modo">

                        <button class="btn btn-dark" onclick="toggleDarkMode()">
                            Activar / Desactivar
                        </button>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script>
    const botones = document.querySelectorAll('.opcion');
    const contenidos = document.querySelectorAll('.contenido');

    botones.forEach(boton => {
        boton.addEventListener('click', () => {
            botones.forEach(btn => btn.classList.remove('active'));
            boton.classList.add('active');

            contenidos.forEach(c => c.classList.add('d-none'));
            document.getElementById(boton.dataset.target).classList.remove('d-none');
        });
    });

    // MODO OSCURO
    function toggleDarkMode() {
        document.body.classList.toggle('bg-dark');
        document.body.classList.toggle('text-white');

        localStorage.setItem('darkMode', document.body.classList.contains('bg-dark'));
    }

    // cargar estado
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('bg-dark', 'text-white');
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>