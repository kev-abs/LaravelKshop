<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Actualizar / Eliminar Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a class="navbar-brand fw-bold" href="{{ route('panel.admin') }}">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="K-Shop" width="60" class="me-2">
            K-SHOP | Admin
            </a>
        </div>
        <nav>
            <a href="Inicio/Controlador/Logueo/CerrarSesion.php" class="btn btn-outline-dark">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="container my-5">
    <!-- Título y descripción -->
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Gestión de Empleados</h2>
        <p class="text-muted">
            Mantén a tu equipo de K-SHOP siempre actualizado. Modifica información importante o elimina registros antiguos de manera segura y eficiente.
        </p>
    </div>

    <div class="row g-4 justify-content-center">

        <!-- Actualizar Empleado -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-dark text-white text-center rounded-top py-2">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Actualizar Empleado
                </h5>
                </div>
                <div class="card-body bg-light p-4">
                <p class="text-muted small mb-4">
                    Modifica los datos del empleado para que tu registro sea confiable y tu equipo funcione de forma óptima.
                </p>
                <!-- Mensajes -->
                @if (!empty($mensaje))
                    <div class="mb-3">
                        <?= $mensaje ?>
                    </div>
                @endif
                    <form method="POST" class="row g-3">
                        @csrf
                        <input type="hidden" name="accion" value="actualizar">

                        <div class="col-md-6">
                            <input type="number" name="id_Empleado" class="form-control rounded-2" placeholder="ID Empleado" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="nombre" class="form-control rounded-2" placeholder="Nombre" required>
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="contrasena" class="form-control rounded-2" placeholder="Contraseña" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="cargo" class="form-control rounded-2" placeholder="Cargo" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="correo" class="form-control rounded-2" placeholder="Correo" required>
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

        <!-- Eliminar Empleado -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-danger text-white text-center rounded-top py-2">
                <h5 class="mb-0">
                    <i class="bi bi-trash-fill me-2"></i>Eliminar Empleado
                </h5>
                </div>
                <div class="card-body bg-light p-4">
                <p class="text-muted small mb-4">
                    Elimina empleados que ya no formen parte del equipo para mantener tu registro limpio y eficiente.
                </p>
                    <form method="POST" class="row g-3 justify-content-center">
                        @csrf
                        <input type="hidden" name="accion" value="eliminar">
                        <div class="col-8 col-md-6">
                            <input type="number" name="id_Empleado" class="form-control rounded-2" placeholder="ID Empleado" required>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-outline-danger btn-lg w-75">
                                <i class="bi bi-x-circle me-2"></i>Eliminar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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

<script>
$(document).ready(function () {

    $("input[name='id_Empleado']").on('keyup', function () {

        let id = $(this).val();

        if (id.length === 0) return;

        $.ajax({
            url: "/usuarios/empleados/buscar/" + id,
            method: "GET",
            success: function (data) {

                if (!data) {
                    $("input[name='nombre']").val("");
                    $("input[name='contrasena']").val("");
                    $("input[name='cargo']").val("");
                    $("input[name='correo']").val("");
                    $("select[name='estado']").val("");
                    return;
                }

                $("input[name='nombre']").val(data.Nombre);
                $("input[name='contrasena']").val("");
                $("input[name='cargo']").val(data.Cargo);
                $("input[name='correo']").val(data.Correo);
                $("select[name='estado']").val(data.Estado);
            }
        });

    });

});
</script>
</body>
</html>
