<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICONOS BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        .card-header {
            background: #f8f9fa;
            font-weight: 600;
        }

        .navbar-brand img {
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('panel.admin') }}">
                <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo" width="55" class="me-2">
                K-SHOP | Admin
            </a>

            <!-- buscador -->
            <form class="d-none d-md-flex mx-auto w-50">
                <input class="form-control" type="search" placeholder="Buscar pedidos..." aria-label="Buscar">
            </form>

            <div class="d-flex">
                <a href="{{ route('logout') }}" class="btn btn-outline-dark">
                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                </a>
            </div>

        </div>
    </nav>

    <!-- CONTENIDO -->
    <main class="container my-5">

        <div class="text-center mb-4">
            <h2 class="fw-bold">Editar Pedido #{{ $pedido['id_Pedido'] }}</h2>
            <p class="text-muted">Modifica la información del pedido seleccionado.</p>
        </div>

        @if(session('msg'))
            <div class="alert alert-info text-center">{{ session('msg') }}</div>
        @endif

        <div class="card shadow-sm mx-auto" style="max-width: 700px;">
            <div class="card-header">
                <i class="bi bi-pencil-square"></i> Formulario de edición
            </div>

            <div class="card-body">

                <form action="{{ route('pedido.update', $pedido['id_Pedido']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- ID Cliente -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">ID Cliente</label>
                        <input type="number" name="id_Cliente" class="form-control"
                            value="{{ $pedido['id_Cliente'] }}" required>
                    </div>

                    <!-- Fecha Pedido -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Fecha del Pedido</label>
                        <input type="date" name="fecha_Pedido" class="form-control"
                            value="{{ $pedido['fecha_Pedido'] }}" required>
                    </div>

                    <!-- Estado -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Estado</label>
                        <input type="text" name="estado" class="form-control"
                            value="{{ $pedido['estado'] }}" required>
                    </div>

                    <!-- Total -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Total</label>
                        <input type="number" name="total" class="form-control"
                            value="{{ $pedido['total'] }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('ventas.pedidos') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Guardar Cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
        </div>
    </footer>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
