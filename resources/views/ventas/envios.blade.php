<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envios</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICONOS BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-light border-bottom shadow-sm">
        <div class="container py-2">

            <a class="navbar-brand fw-bold fs-4" href="#">
                <i class="bi bi-truck"></i> Gestión de Envíos
            </a>

            <!-- BUSCADOR -->
            <form class="d-none d-md-flex mx-auto w-50" role="search">
                <input class="form-control" type="search" placeholder="Buscar en ventas..." aria-label="Buscar">
            </form>

            <!-- CERRAR SESIÓN -->
            <div class="d-flex">
                
                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                </a>
            </div>

        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="container my-5">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Lista de Envíos</h2>
            <p class="text-muted">Gestione, edite o elimine los envíos registrados.</p>
        </div>

        <!-- ALERTA -->
        @if(session('msg'))
            <div class="alert alert-info text-center">
                {{ session('msg') }}
            </div>
        @endif

        <!-- TABLA DE ENVIOS -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>id_Envío</th>
                        <th>id_Pedido</th>
                        <th>Dirección</th>
                        <th>Fecha</th>
                        <th>Método</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($Envios as $e)
                        <tr>
                            <td>{{ $e['id_Envio'] }}</td>
                            <td>{{ $e['id_Pedido'] }}</td>
                            <td>{{ $e['direccionEnvio'] }}</td>
                            <td>{{ $e['fechaEnvio'] }}</td>
                            <td>{{ $e['metodoEnvio'] }}</td>
                            <td>{{ $e['estadoEnvio'] }}</td>

                            <td>
                                <!-- BOTÓN EDITAR -->
                                <a href="{{ url('/envios/'.$e['id_Envio'].'/edit') }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- FORM ELIMINAR -->
                                <form action="{{ route('envios.destroy', $e['id_Envio']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este envío?')">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <em>No hay envíos registrados.</em>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </main>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
