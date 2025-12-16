<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Crear Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<header class="bg-white py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" class="me-2">
            <span class="fw-bold text-dark">K-SHOP</span>
        </div>

        <nav>
            <a href="{{ route('login') }}" class="btn btn-outline-dark">Iniciar Sesión</a>
        </nav>
    </div>
</header>

<main class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Crea tu cuenta</h2>
        <p class="text-muted">
            Únete a K-SHOP y disfruta de compras rápidas, seguras y personalizadas.
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-7 col-xl-6">

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-dark text-white text-center rounded-top py-2">
                    <h5 class="mb-0">
                        <i class="bi bi-person-plus-fill me-2"></i>Formulario de Registro
                    </h5>
                </div>

                <div class="card-body bg-light p-4">
                    <p class="text-muted small mb-4 text-center">
                        Completa tus datos para comenzar a disfrutar de nuestros servicios.
                    </p>

                    @if (!empty($mensaje))
                        <div class="alert alert-info text-center">
                            {{ $mensaje }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('cliente.registrar') }}" class="row g-3">
                        @csrf

                        <!-- Nombre -->
                        <div class="col-md-6">
                            <input type="text" name="nombre" class="form-control rounded-2" placeholder="Nombre completo" required>
                        </div>

                        <!-- Correo -->
                        <div class="col-md-6">
                            <input type="email" name="correo" class="form-control rounded-2" placeholder="Correo electrónico" required>
                        </div>

                        <!-- Contraseña -->
                        <div class="col-md-6">
                            <input type="password" name="contrasena" class="form-control rounded-2" placeholder="Contraseña" required>
                        </div>

                        <!-- Teléfono -->
                        <div class="col-md-6">
                            <input type="text" name="telefono" class="form-control rounded-2" placeholder="Teléfono">
                        </div>

                        <!-- Documento -->
                        <div class="col-md-12">
                            <input type="text" name="documento" class="form-control rounded-2" placeholder="Documento de identidad">
                        </div>

                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-dark btn-lg w-75">
                                <i class="bi bi-check-circle me-2"></i>Crear Cuenta
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="mb-2">¿Ya tienes una cuenta?</p>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg w-50">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
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
