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
        .card {
            border: 2px solid #0d6efd !important; /* borde azul más visible */
            border-radius: 10px;
        }

        label {
            font-weight: 600;
        }
    </style>
</head>

<body>

    <!-- NAVBAR (MISMA QUE TU PRINCIPAL) -->
    <nav class="navbar navbar-expand-lg bg-light border-bottom shadow-sm">
        <div class="container py-2">

            <a class="navbar-brand fw-bold fs-4" href="#">
                <i class="bi bi-truck"></i> Gestión de Envíos
            </a>

            <form class="d-none d-md-flex mx-auto w-50" role="search">
                <input class="form-control" type="search" placeholder="Buscar en ventas..." aria-label="Buscar">
            </form>

            <div class="d-flex">
                <a href="{{ route('logout') }}" class="nav-link">
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

        <!-- CARD -->
        <div class="card shadow-lg p-4">

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
                    <a href="{{ route('ventas.envios') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>

                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Envío
                    </button>
                </div>

            </form>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-light text-center py-3 border-top mt-5">
        <span class="text-muted">© 2025 - Sistema de Envíos</span>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
