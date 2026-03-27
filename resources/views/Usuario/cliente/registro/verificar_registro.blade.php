<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Verificar Cuenta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<header class="bg-white py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">

        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
            <span class="fw-bold text-dark">K-SHOP</span>
        </div>

        <a href="{{ route('login') }}" class="btn btn-outline-dark">
            Iniciar Sesión
        </a>

    </div>
</header>

<main class="container flex-fill d-flex align-items-center justify-content-center">

    <div class="card shadow-sm border-0 p-5 bg-white" style="max-width: 500px; width: 100%;">

        <h3 class="fw-bold mb-3 text-center">
            Verificación de correo
        </h3>

        <p class="text-muted text-center mb-4">
            Hemos enviado un código de verificación a tu correo electrónico.
            Ingresa el código para activar tu cuenta.
        </p>

        @if (session('error'))
            <div class="alert alert-dark text-center">
                {{ session('error') }}
            </div>
        @endif

        @if (session('mensaje'))
            <div class="alert alert-success text-center">
                {{ session('mensaje') }}
            </div>
        @endif

        <form method="POST" action="{{ route('registro.confirmar') }}">
            @csrf

            <div class="mb-4">
                <label class="form-label small fw-semibold">
                    Código de verificación
                </label>

                <input 
                    type="text"
                    name="codigo"
                    class="form-control form-control-lg text-center"
                    placeholder="000000"
                    required
                >
            </div>

            <button class="btn btn-dark w-100 py-3 fw-semibold">
                Verificar cuenta
            </button>

        </form>

        <div class="mt-4 text-center">

            <form method="POST" action="{{ route('registro.reenviar') }}">
                @csrf
                <button class="btn btn-outline-dark btn-sm">
                    Reenviar código
                </button>
            </form>

        </div>

        <p class="text-muted small text-center mt-4">
            El código expira en 2 minutos por motivos de seguridad.
        </p>

    </div>

</main>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

</body>
</html>