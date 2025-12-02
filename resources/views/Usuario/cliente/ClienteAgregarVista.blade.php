<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Agregar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" class="me-2">
            <span class="fw-bold text-dark">K-SHOP | Admin</span>
        </div>

        <nav>
            <a href="{{ route('logout') }}" class="btn btn-outline-dark">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Agregar Nuevo Cliente</h2>
        <p class="text-muted">
            Registra un cliente en el sistema para poder gestionar sus compras y mantener su información siempre actualizada.
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
                        Completa los datos del cliente de forma correcta para ofrecerle un mejor servicio.
                    </p>

                    @if (!empty($mensaje))
                        <div class="alert alert-info text-center">
                            {{ $mensaje }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('clientes.agregar') }}" class="row g-3">
                        @csrf

                        <div class="col-md-4">
                            <input type="text" name="nombre" class="form-control rounded-2" placeholder="Nombre" required>
                        </div>

                        <div class="col-md-4">
                            <input type="email" name="correo" class="form-control rounded-2" placeholder="Correo" required>
                        </div>

                        <div class="col-md-4">
                            <input type="password" name="contrasena" class="form-control rounded-2" placeholder="Contraseña" required>
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="documento" class="form-control rounded-2" placeholder="Documento">
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="telefono" class="form-control rounded-2" placeholder="Teléfono">
                        </div>

                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-dark btn-lg w-75">
                                <i class="bi bi-check-circle me-2"></i>Agregar Cliente
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('clientes.consultar') }}" class="btn btn-outline-secondary btn-lg w-50">
                    <i class="bi bi-arrow-left me-2"></i>Volver
                </a>
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
