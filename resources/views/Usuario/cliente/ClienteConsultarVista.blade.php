<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Consultar Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center" href="/ModeloVistaControlador/index.php?Controller=panel&action=manejarPeticion">
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

@if(session('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
@endif

<main class="container my-5">
    <!-- Título y descripción -->
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Listado de Clientes</h2>
        <p class="text-muted">
            Consulta todos los clientes registrados en K-SHOP de manera clara y organizada. 
            Mantén la información actualizada para mejorar la gestión de ventas y la relación con tus clientes.
        </p>
    </div>

    <?= $mensaje ?? "" ?>
    
    <div class="row mb-4">

        <!-- Total Clientes -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-muted">Total Clientes</h6>
                    <h3 class="fw-bold">{{ $totalClientes }}</h3>
                </div>
            </div>
        </div>

        <!-- Cliente más activo -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-muted">Cliente Más Activo</h6>
                    <h5 class="fw-bold">
                        {{ $clienteMasFrecuente->Nombre ?? 'N/A' }}
                    </h5>
                    <small class="text-muted">
                        {{ $clienteMasFrecuente->total_logins ?? 0 }} logins
                    </small>
                </div>
            </div>
        </div>

        <!-- Top 5 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted text-center">Top 5 Clientes</h6>
                    <ul class="list-group list-group-flush">
                        @foreach($top5 as $t)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $t->Nombre }}</span>
                                <span class="badge bg-dark">
                                    {{ $t->total_logins }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="orden" class="form-select">
                    <option value="c.ID_Cliente">ID</option>
                    <option value="c.Nombre">Nombre</option>
                    <option value="c.Documento">Documento</option>
                    <option value="total_logins">Total Logins</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="direccion" class="form-select">
                    <option value="asc">Ascendente</option>
                    <option value="desc">Descendente</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-dark">Ordenar</button>
            </div>
        </div>
    </form>


    @if($clientes->count() > 0)
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-dark text-white text-center rounded-top py-2">
                <h5 class="mb-0">
                    <i class="bi bi-people-fill me-2"></i>Clientes Registrados
                </h5>
            </div>

            <div class="card-body bg-light p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center mb-0">
                        <thead class="table-secondary text-dark">
                            <tr>
                                <th>ID</th>
                                <th class="text-start ps-3">Nombre</th>
                                <th>Correo</th>
                                <th>Contraseña</th>
                                <th>Documento</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th>Fecha Registro</th>
                                <th>Logins</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $c)
                                <tr>
                                    <td>{{ $c->ID_Cliente }}</td>
                                    <td class="text-start ps-3">{{ $c->Nombre }}</td>
                                    <td>{{ $c->Correo }}</td>
                                    <td><span class="text-muted">********</span></td>
                                    <td>{{ $c->Documento }}</td>
                                    <td>{{ $c->Telefono }}</td>

                                    <td>
                                        @if($c->Estado === 'Activo')
                                        <span class="badge bg-success">{{ $c->Estado }}</span>
                                        @elseif($c->Estado === 'Inactivo')
                                        <span class="badge bg-secondary">{{ $c->Estado }}</span>
                                        @else
                                        <span class="badge bg-warning text-dark">{{ $c->Estado }}</span>
                                        @endif
                                    </td>

                                    <td>{{ $c->Fecha_Registro }}</td>
                                    <td>{{ $c->total_logins }}</td>

                                    <td class="d-flex justify-content-center gap-2">

                                        <!-- EDITAR -->
                                        <a href="{{ route('clientes.editar.form', $c->ID_Cliente) }}"
                                        class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <!-- ELIMINAR -->
                                        <form action="{{ route('clientes.eliminar', $c->ID_Cliente) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEliminar{{ $c->ID_Cliente }}">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalEliminar{{ $c->ID_Cliente }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content rounded-4 shadow">

                                                        <div class="modal-body text-center p-4">
                                                            <i class="bi bi-exclamation-circle text-danger fs-1 mb-3"></i>
                                                            <h5 class="fw-bold">¿Eliminar cliente?</h5>
                                                            <p class="text-muted small">
                                                                Esta acción no se puede deshacer.
                                                            </p>

                                                            <div class="d-flex justify-content-center gap-3 mt-3">
                                                                <button type="submit" class="btn btn-danger px-4">
                                                                    Sí, eliminar
                                                                </button>

                                                                <button type="button"
                                                                        class="btn btn-outline-secondary px-4"
                                                                        data-bs-dismiss="modal">
                                                                    Cancelar
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </form>


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
            No hay clientes registrados aún. ¡Agrega nuevos clientes para comenzar a gestionar!
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
