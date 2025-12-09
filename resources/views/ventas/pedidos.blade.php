<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>

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
                <i class="bi bi-receipt"></i> Gestión de Pedidos
            </a>

            <!-- BUSCADOR -->
            <form class="d-none d-md-flex mx-auto w-50" role="search">
                <input class="form-control" type="search" placeholder="Buscar pedidos..." aria-label="Buscar">
            </form>

            <!-- CERRAR SESIÓN -->
            <div class="d-flex">
                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
            </div>

        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="container my-5">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Lista de Pedidos</h2>
            <p class="text-muted">Gestione, edite o elimine los pedidos registrados.</p>
        </div>

        <!-- ALERTA -->
        @if(session('msg'))
            <div class="alert alert-info text-center">
                {{ session('msg') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('ventas.pedidos_create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Nuevo pedido
            </a>
        </div>

        <!-- TABLA DE PEDIDOS -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID Pedido</th>
                        <th>ID Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($Pedidos as $p)
                        <tr>
                            <td>{{ $p['id_Pedido'] }}</td>
                            <td>{{ $p['id_Cliente'] }}</td>
                            <td>{{ $p['fecha_Pedido'] }}</td>
                            <td>{{ $p['estado'] }}</td>
                            <td>${{ number_format($p['total'], 0, ',', '.') }}</td>

                            <td>
                                <!-- EDITAR -->
                            

                                <!-- ELIMINAR -->
                                <form action="{{ route('pedidos.destroy', $p['id_Pedido']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este pedido?')">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <em>No hay pedidos registrados.</em>
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
