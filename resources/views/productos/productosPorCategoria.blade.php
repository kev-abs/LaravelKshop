<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Productos por Categoría</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" class="me-2">
      <a href="{{route('panel.admin')}}" class="text-decoration-none fs-7 fw-bold text-dark">K-SHOP | Admin</a>
    </div>
    </div>
</header>

<main class="container my-5">

    <!-- Título -->
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Productos por Categoría</h2>
        <p class="text-muted">
            Visualiza los productos organizados por cada categoría registrada.
        </p>
    </div>
    <div class="text-center mb-4">
    <a href="{{ route('categorias.index') }}" class="btn btn-dark btn-lg">
        <i class="bi bi-tags me-2"></i>Gestionar Categorías
    </a>
</div>

    @if(isset($categorias) && count($categorias) > 0)

        @foreach($categorias as $categoria)

            <div class="card shadow-sm border-0 rounded-3 mb-5">

                <!-- CABECERA CATEGORÍA -->
                <div class="card-header bg-dark text-white text-center">
                    <h5 class="mb-0">
                        <i class="bi bi-folder2-open me-2"></i>
                        {{ $categoria['nombre'] }}
                    </h5>
                </div>

                <div class="card-body bg-light p-4">

                    @if(isset($categoria['productos']) && count($categoria['productos']) > 0)

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle text-center mb-0">

                                <thead class="table-secondary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($categoria['productos'] as $p)
                                    <tr>
                                        <td>{{ $p['idProducto'] }}</td>
                                        <td class="fw-semibold">{{ $p['nombre'] }}</td>
                                        <td>{{ $p['descripcion'] ?? '—' }}</td>
                                        <td>${{ number_format($p['precio'], 0, ',', '.') }}</td>
                                        <td>
                                    @if ($p['imagen'])
                                        <img src="http://35.175.5.116:8080/uploads/productos/{{ $p['imagen'] }}" width="80" alt="Producto">

                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td>
    <a href="{{ route('productos.editarCategoria', $p['idProducto']) }}" 
       class="btn btn-warning btn-sm">
        <i class="bi bi-pencil"></i> Editar categoría
    </a>
</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                    @else
                        <div class="alert alert-warning text-center mb-0">
                            Esta categoría no tiene productos asignados.
                        </div>
                    @endif

                </div>
            </div>

        @endforeach

    @else
        <div class="alert alert-warning text-center">
            No hay categorías registradas.
        </div>
    @endif

    <div class="text-center mt-5">
        <a href="{{ route('panel.admin') }}" class="btn btn-outline-secondary btn-lg w-50">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>

</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
</footer>

</body>
</html>