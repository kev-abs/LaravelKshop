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

<main class="container-fluid flex-fill">

    <div class="row min-vh-100">

        <!-- COLUMNA FORMULARIO -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white">

            <div class="w-100 px-4" style="max-width: 500px;">

                <!-- TITULO -->
                <h2 class="fw-bold mb-2">
                    Crear cuenta
                </h2>

                <p class="text-muted mb-4">
                    Regístrate para comprar más rápido, ver tus pedidos y recibir ofertas exclusivas.
                </p>

                @if (!empty($mensaje))
                    <div class="alert alert-info">
                        {{ $mensaje }}
                    </div>
                @endif

                <!-- FORM -->
                <form method="POST" action="{{ route('cliente.registrar') }}" class="row g-3">
                    @csrf

                    <!-- Nombre -->
                    <div class="col-12">
                        <label class="form-label small fw-semibold">
                            Nombre completo *
                        </label>

                        <input 
                            type="text"
                            name="nombre"
                            class="form-control form-control-lg rounded-0"
                            required
                        >
                    </div>

                    <!-- Correo -->
                    <div class="col-12">
                        <label class="form-label small fw-semibold">
                            Correo electrónico *
                        </label>

                        <input 
                            type="email"
                            name="correo"
                            class="form-control form-control-lg rounded-0"
                            required
                        >
                    </div>

                    <!-- Contraseña -->
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">
                            Contraseña *
                        </label>

                        <input 
                            type="password"
                            name="contrasena"
                            class="form-control form-control-lg rounded-0"
                            required
                        >
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">
                            Teléfono
                        </label>

                        <input 
                            type="text"
                            name="telefono"
                            class="form-control form-control-lg rounded-0"
                        >
                    </div>

                    <!-- Documento -->
                    <div class="col-12">
                        <label class="form-label small fw-semibold">
                            Documento de identidad
                        </label>

                        <input 
                            type="text"
                            name="documento"
                            class="form-control form-control-lg rounded-0"
                        >
                    </div>

                    <!-- BOTÓN -->
                    <div class="col-12 mt-3">

                        <button class="btn btn-dark w-100 py-3 rounded-0 fw-semibold">
                            Crear cuenta
                        </button>

                    </div>

                </form>

                <!-- LOGIN LINK -->
                <div class="mt-4 text-center">

                    <span class="text-muted">
                        ¿Ya tienes una cuenta?
                    </span>

                    <a href="{{ route('login') }}" 
                       class="fw-semibold text-dark text-decoration-none ms-1">
                        Iniciar sesión
                    </a>

                </div>

            </div>

        </div>


        <!-- COLUMNA IMAGEN -->
        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-light">

            <img 
                src="{{ asset('img/foto_registro.png') }}"
                class="img-fluid w-75"
                alt="Productos K-SHOP"
            >

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
