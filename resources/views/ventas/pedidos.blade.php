<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Gestión de Pedidos</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        .table thead th {
            background-color: #343a40 !important;
            color: white;
        }

        .btn-action {
            padding: 5px 10px;
        }

        .navbar-brand img {
            border-radius: 8px;
        }

        .btn-back {
            width: 55px;
            height: 55px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 26px;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('panel.admin') }}">
                <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="K-Shop" width="60" class="me-2">
                K-SHOP | Admin
            </a>

            <form class="d-none d-md-flex mx-auto w-50" role="search">
                <input class="form-control" type="search" placeholder="Buscar pedidos..." aria-label="Buscar">
            </form>

            <div class="d-flex">
                <a href="{{ route('logout') }}" class="btn btn-outline-dark">
                    <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                </a>
            </div>

        </div>
    </nav>




    <!-- CONTENIDO PRINCIPAL -->
    <main class="container my-5">

    

        <div class="text-center mb-4">
            <h2 class="fw-bold">Gestión de Pedidos</h2>
            <p class="text-muted">Administra, edita o elimina los registros de pedidos.</p>
        </div>

        @if(session('msg'))
            <div class="alert alert-info text-center">
                {{ session('msg') }}
            </div>
        @endif

        
        <div class="d-flex justify-content-between mb-3">

           
            <a href="{{ route('ventas.ventas') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>

            
            <a href="{{ route('ventas.pedidos_create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nuevo Pedido
            </a>

        </div>


        <!-- TABLA -->
        <div class="card shadow-sm">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>ID Cliente</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th class="text-center">Acciones</th>
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

                                    <td class="text-center">

                                        <!-- EDITAR -->
                                        <a href="{{ route('ventas.pedido', $p['id_Pedido']) }}" 
                                           class="btn btn-warning btn-sm me-1 btn-action">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <!-- ELIMINAR -->
                                        <form action="{{ route('pedidos.destroy', $p['id_Pedido']) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-outline-danger btn-sm btn-action"
                                                    onclick="return confirm('¿Está seguro de eliminar este pedido?')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>

                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        No hay pedidos registrados.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </main>



    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <div class="mb-3">
                <a href="#" class="text-white me-3">Términos</a>
                <a href="#" class="text-white me-3">Privacidad</a>
                <a href="#" class="text-white">Ayuda</a>
            </div>

            <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
        </div>
    </footer>


    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
