<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checkout - K-Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
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
            <a href="{{ route('ventas.carrito') }}" class="text-dark">
                <i class="bi bi-cart"></i>
            </a>
        </nav>
    </div>
</header>

<!-- CONTENIDO -->
<main class="container flex-grow-1 my-4">

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="bg-white border rounded-3 p-4 shadow-sm">

                <h5 class="fw-semibold mb-4 text-center">
                    Finalizar compra
                </h5>

                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label small text-muted">
                            Dirección de envío
                        </label>
                        <input type="text" name="direccion" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">
                            Método de pago
                        </label>
                        <select name="metodo_pago" class="form-select" required>
                            <option value="EFECTIVO">Efectivo</option>
                            <option value="TARJETA">Tarjeta</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small text-muted">
                            Tipo de entrega
                        </label>
                        <select name="tipo_entrega" class="form-select" required>
                            <option value="CONTRAENTREGA">Contra-Entrega</option>
                            <option value="PUNTOENTREGA">Punto de entrega</option>
                        </select>
                    </div>

                    <button class="btn btn-dark w-100">
                        Confirmar compra
                    </button>
                </form>

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
