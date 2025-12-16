<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra confirmada - K-Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

<!-- NAVBAR -->
<header class="bg-white sticky-top border-bottom">
    <div class="container d-flex justify-content-between align-items-center py-2">
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="70" class="me-2">
            <a href="{{ route('inicio') }}" class="fw-semibold text-dark text-decoration-none">
                K-SHOP
            </a>
        </div>

        <nav class="d-flex gap-3 small">
            <a href="{{ route('productos.catalogo') }}" class="text-dark text-decoration-none">
                Productos
            </a>
        </nav>
    </div>
</header>

<!-- CONTENIDO -->
<main class="container flex-grow-1 my-5">

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="bg-white border rounded-3 p-4 text-center shadow-sm">

                <h5 class="fw-semibold mb-2">
                    Compra realizada con éxito
                </h5>

                <p class="text-muted small mb-4">
                    Tu pedido fue registrado correctamente.
                </p>

                <a href="{{ route('productos.catalogo') }}"
                   class="btn btn-outline-dark btn-sm">
                    Seguir comprando
                </a>

            </div>

        </div>
    </div>

</main>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
    <div class="container">
        <div class="mb-3">
            <a href="#" class="text-white me-3">Términos</a>
            <a href="#" class="text-white me-3">Privacidad</a>
            <a href="#" class="text-white">Ayuda</a>
        </div>
        <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
    </div>
</footer>

</body>
</html>
