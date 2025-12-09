<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Actualizar / Eliminar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center" href="#">
            <img src="Inicio/Public/Imagenes/logo_kshopsinfondo.png" alt="Logo K-Shop" width="83" class="me-2">
            <span class="fw-bold text-dark">K-SHOP | Admin</span>
        </div>
        <nav>
            <a href="Inicio/Controlador/Logueo/CerrarSesion.php" class="btn btn-outline-dark">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="container my-5">
    <!-- Título y descripción -->
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Gestión de Clientes</h2>
        <p class="text-muted">
            Mantén la información de tus clientes siempre actualizada. 
            Actualiza datos importantes o elimina registros antiguos de forma segura y rápida.
        </p>
    </div>

    <div class="row g-4 justify-content-center">

        <!-- Actualizar Cliente -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-dark text-white text-center rounded-top py-2">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Actualizar Cliente
                    </h5>
                </div>
                <div class="card-body bg-light p-4">
                    <p class="text-muted small mb-4">
                        Modifica los datos del cliente con facilidad. Asegúrate de que la información esté siempre correcta y completa.
                    </p>

                    <!-- Mensajes -->
                    @if (!empty($mensaje))
                        <div class="alert alert-info">{{ $mensaje }}</div>
                    @endif

                    

                    <form method="POST" class="row g-3">
                        @csrf
                        <input type="hidden" name="accion" value="actualizar">
                        
                        <div class="col-md-6">
                            <input type="number" name="id_Cliente" class="form-control rounded-2" placeholder="ID Cliente" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="nombre" class="form-control rounded-2" placeholder="Nombre" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="correo" class="form-control rounded-2" placeholder="Correo" required>
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="contrasena" class="form-control" placeholder="Nueva Contraseña">
                        </div>

                        <div class="col-md-6">
                            <input type="text" name="documento" class="form-control rounded-2" placeholder="Documento">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="telefono" class="form-control rounded-2" placeholder="Teléfono">
                        </div>
                        <div class="col-md-6">
                            <select name="estado" class="form-select rounded-2">
                                <option value="" disabled selected>Estado</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                                <option value="Suspendido">Suspendido</option>
                            </select>
                        </div>

                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-dark btn-lg w-75">
                                <i class="bi bi-check-circle me-2"></i>Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Eliminar Cliente -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-secondary text-white text-center rounded-top py-2">
                    <h5 class="mb-0">
                        <i class="bi bi-trash-fill me-2"></i>Eliminar Cliente
                    </h5>
                </div>
                <div class="card-body bg-light p-4">
                    <p class="text-muted small mb-4">
                        Elimina registros antiguos o incorrectos. Una herramienta potente para mantener tu base de datos limpia y eficiente.
                    </p>
                    <form method="POST" class="row g-3 justify-content-center">
                        @csrf
                        <input type="hidden" name="accion" value="eliminar">
                        <div class="col-8 col-md-6">
                            <input type="number" name="id_Cliente" class="form-control rounded-2" placeholder="ID Cliente" required>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-outline-dark btn-lg w-75">
                                <i class="bi bi-x-circle me-2"></i>Eliminar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Volver -->
    <div class="text-center mt-5">
        <a href="{{ route('clientes.consultar') }}" class="btn btn-outline-secondary btn-lg w-50">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>
</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <div class="container">
        <div class="mb-3">
            <a href="#" class="text-white me-3">Términos y condiciones</a>
            <a href="#" class="text-white me-3">Política de privacidad</a>
            <a href="#" class="text-white me-3">Ayuda</a>
        </div>
        <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
    </div>
</footer>

<!-- JQuery para AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- AUTOCOMPLETADO POR ID -->
<script>
$(document).ready(function () {

    $("input[name='id_Cliente']").on('keyup', function () {

        let id = $(this).val();

        if (id.length === 0) return;

        $.ajax({
            url: "/usuarios/clientes/buscar/" + id,
            method: "GET",
            success: function (data) {

                if (!data) {
                    $("input[name='nombre']").val("");
                    $("input[name='correo']").val("");
                    $("input[name='documento']").val("");
                    $("input[name='telefono']").val("");
                    $("select[name='estado']").val("");
                    return;
                }

                $("input[name='nombre']").val(data.Nombre);
                $("input[name='correo']").val(data.Correo);
                $("input[name='documento']").val(data.Documento);
                $("input[name='telefono']").val(data.Telefono);
                $("select[name='estado']").val(data.Estado);
            }
        });

    });

});
</script>

</body>
</html>
