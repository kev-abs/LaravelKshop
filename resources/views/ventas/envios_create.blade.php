<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Envío</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        .card-header {
            background: #f8f9fa;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .navbar-brand img {
            border-radius: 8px;
        }

        label {
            font-weight: 600;
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- NAVBAR UNIFICADO -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('panel.admin') }}">
                <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo" width="55" class="me-2">
                K-SHOP | Admin
            </a>

            <!-- Buscador -->
            <form class="d-none d-md-flex mx-auto w-50">
                <input class="form-control" type="search" placeholder="Buscar envíos..." aria-label="Buscar">
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
            <h2 class="fw-bold">Agregar Envío</h2>
            <p class="text-muted">Complete el formulario para registrar un nuevo envío.</p>
        </div>

        <div class="card shadow-sm mx-auto" style="max-width: 750px;">
            <div class="card-header">
                <i class="bi bi-truck"></i> Registro de Envío
            </div>

            <div class="card-body">

                <form action="{{ route('envios.store') }}" method="POST">
                    @csrf

                    <div class="row g-4">

                        <div class="col-md-6">
                            <label class="form-label">ID Pedido</label>
                            <input type="text" name="id_Pedido" class="form-control border border-primary" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Dirección de Envío</label>
                            <input type="text" name="direccionEnvio" class="form-control border border-primary" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Fecha de Envío</label>
                            <input type="date" name="fechaEnvio" class="form-control border border-primary" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Método de Envío</label>
                            <input type="text" name="metodoEnvio" class="form-control border border-primary" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Estado del Envío</label>
                            <select name="estadoEnvio" class="form-select border border-primary" required>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Enviado">Enviado</option>
                            </select>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('ventas.envios') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>

                        <button class="btn btn-primary">
                            <i class="bi bi-save"></i> Guardar Envío
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

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
