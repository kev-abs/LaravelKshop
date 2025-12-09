<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card shadow p-4" style="max-width: 450px; width: 100%;">
    <h3 class="text-center mb-3 fw-bold">Recuperar Contraseña</h3>
    <p class="text-muted text-center">Ingresa tu correo y te enviaremos un código.</p>

    @if(session('mensaje'))
        <div class="alert alert-danger text-center">{{ session('mensaje') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <input type="email" class="form-control" name="correo" placeholder="Correo electrónico" required>
        </div>

        <button class="btn btn-dark w-100">Enviar código</button>
    </form>
</div>

</body>
</html>
