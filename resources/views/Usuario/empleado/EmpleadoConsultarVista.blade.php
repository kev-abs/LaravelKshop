<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Consultar Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a class="navbar-brand fw-bold" href="{{ route('usuariosVista') }}">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="K-Shop" width="60" class="me-2">
            K-SHOP | Admin
            </a>
        </div>
        <nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-dark">
                    Cerrar sesión
                </button>
            </form>
        </nav>
    </div>
</header>

<main class="container my-5">

    <!-- Título y descripción -->
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Consulta de Empleados</h2>
        <p class="text-muted">
            Visualiza y analiza toda la información de tu equipo. Mantén un registro actualizado para mejorar la coordinación y la eficiencia en la tienda.
        </p>
    </div>

    <?= $mensaje ?? "" ?>

    @if($empleados->count() > 0)
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-dark text-white text-center rounded-top py-2">
                <h5 class="mb-0">
                    <i class="bi bi-people-fill me-2"></i>Empleados Registrados
                </h5>
            </div>

            <div class="card-body bg-light p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center mb-0">
                        <thead class="table-secondary text-dark">
                            <tr>
                                <th>ID</th>
                                <th class="text-start ps-3">Nombre</th>
                                <th>Cargo</th>
                                <th>Correo</th>
                                <th>Contraseña</th>
                                <th>Estado</th>
                                <th>Fecha Contratación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados as $e)
                                <tr>
                                    <td>{{ $e->ID_Empleado }}</td>
                                    <td class="text-start ps-3">{{ $e->Nombre }}</td>
                                    <td>{{ $e->Cargo }}</td>
                                    <td>{{ $e->Correo }}</td>
                                    <td>{{ $e->Contrasena }}</td>

                                    <td>
                                        @if($e->Estado === 'Activo')
                                            <span class="badge bg-success">{{ $e->Estado }}</span>
                                        @elseif($e->Estado === 'Inactivo')
                                            <span class="badge bg-secondary">{{ $e->Estado }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark">{{ $e->Estado }}</span>
                                        @endif
                                    </td>

                                    <td>{{ $e->Fecha_Contratacion }}</td>

                                    <td>
                                        <a href="{{ route('empleados.editar', $e->ID_Empleado) }}" class="btn btn-sm btn-outline-dark">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    @else
        <div class="alert alert-warning text-center mt-4 shadow-sm">
            No hay empleados registrados aún.
        </div>
    @endif
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

</body>
</html>
