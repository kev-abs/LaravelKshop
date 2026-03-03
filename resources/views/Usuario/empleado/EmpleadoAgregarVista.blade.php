<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Agregar Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a class="navbar-brand fw-bold" href="{{ route('usuariosVista') }}">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="K-Shop" width="60" class="me-2">
            K-SHOP | Admin
            </a>
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

<main class="container my-5">
    <!-- Título y descripción -->
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Agregar Nuevo Empleado</h2>
        <p class="text-muted">
            Incorpora miembros a tu equipo de K-SHOP. Registrar empleados correctamente garantiza un flujo de trabajo eficiente y un excelente servicio.
        </p>
    </div>

    <div class="row g-4 justify-content-center">

        <!-- Agregar Empleado -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-dark text-white text-center rounded-top py-2">
                <h5 class="mb-0">
                    <i class="bi bi-person-plus-fill me-2"></i>Agregar Empleado
                </h5>
                </div>
                <div class="card-body bg-light p-4">
                    <p class="text-muted small mb-4">
                        Completa los datos del empleado y asegúrate de registrar correctamente su información para un manejo adecuado del equipo.
                    </p>
                    <!-- Mensajes -->
                    @if (!empty($mensaje))
                        <div class="mb-3">
                            <?= $mensaje ?>
                        </div>
                    @endif
                    <form method="POST" class="row g-3">
                        @csrf
                        <input type="hidden" name="accion" value="agregar">

                        <div class="col-md-6">
                            <input type="text" name="nombre" class="form-control rounded-2" placeholder="Nombre" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="cargo" class="form-control rounded-2" placeholder="Cargo" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="correo" class="form-control rounded-2" placeholder="Correo" required>
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="contrasena" class="form-control rounded-2" placeholder="Contraseña" required>
                        </div>
                        <div class="col-md-6">
                            <select name="estado" class="form-select rounded-2">
                                <option value="" disabled selected>Estado</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                                <option value="Suspendido">Suspendido</option>
                            </select>
                        </div>

                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-dark btn-lg w-75">
                                <i class="bi bi-check-circle me-2"></i>Agregar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</main>



<footer class="bg-dark text-white text-center py-4 mt-auto">
    <div class="container">
        <div class="mb-3">
            <a href="#" class="text-white me-3">Términos y condiciones</a>
            <a href="#" class="text-white me-3">Política de privacidad</a>
            <a href="#" class="text-white me-3">Ayuda</a>
        </div>
        <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
    </div>
</footer>

</body>
</html>
