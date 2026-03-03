<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP | Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="vh-100">

    <div class="container-fluid h-100">
    <div class="row h-100 g-0">


        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-dark">
            <img src="{{ asset('img/foto_olvidarcontraseña.png') }}" alt="K-SHOP Recuperar Contraseña" class="img-fluid w-100 h-100"style="object-fit: cover;">
        </div>

        <!-- Formulario derecho -->
        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center bg-light">
            <div class="p-4 p-md-5 w-100" style="max-width: 420px;">

                <div class="text-center mb-4">
                    <h2 class="fw-bold text-uppercase">Recuperar Contraseña</h2>
                    <p class="text-muted mb-0">Ingresa tu correo y te enviaremos un código de verificación.</p>
                </div>

                @if(session('mensaje'))
                    <div class="alert alert-danger text-center">{{ session('mensaje') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="correo" class="form-label fw-semibold">Correo electrónico</label>
                        <input type="email" id="correo" class="form-control form-control-lg" name="correo" placeholder="ejemplo@correo.com" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-dark btn-lg">Enviar código</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-muted text-decoration-none">
                    Volver al inicio de sesión
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>