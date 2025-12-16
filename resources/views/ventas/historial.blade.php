<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Compras - K-Shop</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f8;
        }

        /* CONTENEDOR */
        .historial-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start; /* 👈 IZQUIERDA SIEMPRE */
            gap: 16px;
        }

        /* CARD SOBRIA */
        .compra-card {
            width: 300px;
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 6px;
        }

        .compra-card .card-body {
            padding: 16px;
        }

        .compra-id {
            font-size: 0.9rem;
            font-weight: 600;
            color: #212529;
        }

        .compra-text {
            font-size: 0.85rem;
            color: #495057;
            margin-bottom: 6px;
        }

        .compra-meta {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .divider {
            border-top: 1px solid #e9ecef;
            margin: 10px 0;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- NAVBAR -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">

        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="83" class="me-2">
            <a href="{{ route('panel.cliente') }}" class="fw-semibold text-dark text-decoration-none">
                K-SHOP | Cliente
            </a>
        </div>

        <nav class="d-flex align-items-center gap-3">
            <a href="{{ route('productos.catalogo') }}" class="nav-link text-dark">
                Productos
            </a>

            <a href="{{ route('ventas.carrito') }}" class="btn btn-outline-dark border-0">
                <i class="bi bi-cart-fill"></i>
            </a>
        </nav>
    </div>
</header>

<!-- CONTENIDO -->
<div class="container my-5 flex-grow-1">

    <h4 class="fw-semibold mb-4">
        Historial de compras
    </h4>

    @if(empty($compras))
        <div class="alert alert-light border text-muted">
            No hay compras registradas.
        </div>
    @else
        <div class="historial-grid">
            @foreach($compras as $c)
                <div class="card compra-card">

                    <div class="card-body">
                        <div class="compra-id">
                            Compra {{ $c['id_Checkout'] }}
                        </div>

                        <div class="divider"></div>

                        <div class="compra-text">
                            <strong>Dirección:</strong><br>
                            {{ $c['direccion'] }}
                        </div>

                        <div class="compra-text">
                            <strong>Método de pago:</strong> {{ $c['metodoPago'] }}
                        </div>

                        <div class="compra-text">
                            <strong>Tipo de entrega:</strong> {{ $c['tipoEntrega'] }}
                        </div>

                        <div class="divider"></div>

                        <div class="compra-meta">
                            {{ \Carbon\Carbon::parse($c['fecha_Checkout'])->format('d/m/Y H:i') }}
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
    <div class="container">
        <p class="mb-0">&copy; 2025 K-Shop · Todos los derechos reservados</p>
    </div>
</footer>

</body>
</html>
