<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código - K-SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-white py-3 border-bottom shadow-sm">
    <div class="container text-center">
        <h4 class="fw-bold">Verificación de Empleado</h4>
    </div>
</header>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">

            <div class="card shadow-sm">
                <div class="card-body text-center">

                    <h5 class="mb-3">Ingresa el código enviado al correo</h5>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('empleados.verificar') }}">
                        @csrf

                        <input type="text" name="codigo" class="form-control mb-3 text-center" placeholder="Código de 6 dígitos" required>

                        <button type="submit" class="btn btn-dark w-100">
                            Verificar
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</main>

<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p class="mb-0">&copy; 2025 K-SHOP</p>
</footer>

</body>
</html>