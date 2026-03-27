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

    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Agregar Nuevo Empleado</h2>
        <p class="text-muted">
            Registra un empleado en el sistema para gestionar correctamente el equipo de trabajo.
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-dark text-white text-center rounded-top py-2">
                    <h5 class="mb-0">
                        <i class="bi bi-person-plus-fill me-2"></i>Formulario de Registro
                    </h5>
                </div>

                <div class="card-body bg-light p-4">
                    <p class="text-muted small mb-4">
                        Completa los datos del empleado correctamente para un mejor control del sistema.
                    </p>

                    @if (!empty($mensaje))
                        <div class="alert alert-info text-center">
                            {{ $mensaje }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger shadow-lg rounded-2xl border-l-4 border-red-500 bg-gradient-to-r from-red-500/20 to-red-600/10 text-red-800 p-4 mb-4">
                            <strong>¡¡Error!!:</strong>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success shadow-lg rounded-2xl border-l-4 border-green-500 bg-gradient-to-r from-green-500/20 to-green-600/10 text-green-800 p-4 mb-4">
                            <strong>¡¡Éxito!!:</strong>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('empleados.agregar') }}" class="row g-3">
                        @csrf

                        <div class="col-md-4">
                            <input type="text" name="nombre" class="form-control rounded-2" placeholder="Nombre" required>
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="cargo" class="form-control rounded-2" placeholder="Cargo" required>
                        </div>

                        <div class="col-md-4">
                            <select name="cargo" class="form-select rounded-2" required>
                                <option value="" disabled selected>Cargo</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Vendedor">Vendedor</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="email" name="correo" class="form-control rounded-2" placeholder="Correo" required>
                        </div>

                        <div class="col-md-4">
                            <input type="password" name="contrasena" class="form-control rounded-2" placeholder="Contraseña" required>
                        </div>

                        <div class="col-md-4">
                            <input type="password" name="confirmar_contrasena" class="form-control rounded-2" placeholder="Confirmar Contraseña" required>
                        </div>

                        <div class="col-md-4">
                            <input type="number" name="telefono" class="form-control rounded-2" placeholder="Telefono" required>
                        </div>

                        <div class="col-md-4">
                            <input type="number" name="documento" class="form-control rounded-2" placeholder="Documento" required>
                        </div>
                        

                        <div class="col-md-4">
                            <select name="estado" class="form-select rounded-2" required>
                                <option value="" disabled selected>Estado</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                                <option value="Suspendido">Suspendido</option>
                            </select>
                        </div>

                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-dark btn-lg w-75">
                                <i class="bi bi-check-circle me-2"></i>Agregar Empleado
                            </button>
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

</body>
</html>