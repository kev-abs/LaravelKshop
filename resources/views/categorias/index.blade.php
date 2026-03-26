<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" class="me-2">
            <span class="fw-bold text-dark">K-SHOP | Admin</span>
        </div>
    </div>
</header>

<main class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Gestión de Categorías</h2>
        <p class="text-muted">Agrega, edita o elimina categorías.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Formulario agregar categoría -->
    <div class="card shadow-sm border-0 rounded-3 mb-5">
        <div class="card-header bg-dark text-white text-center">
            <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Nueva Categoría</h5>
        </div>
        <div class="card-body bg-light p-4">
            <form action="{{ route('categorias.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-9">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre de la categoría" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check2-circle me-2"></i>Agregar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de categorías -->
    <div class="card shadow-sm border-0 rounded-3 mb-5">
        <div class="card-header bg-dark text-white text-center">
            <h5 class="mb-0"><i class="bi bi-tags me-2"></i>Categorías registradas</h5>
        </div>
        <div class="card-body bg-light p-4">
            @if(count($categorias) > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($categorias as $c)
                            <tr>
                                <td>{{ $c['idCategoria'] }}</td>
                                <td>{{ $c['nombre'] }}</td>
                                <td>
                                    <a href="{{ route('categorias.edit', $c['idCategoria']) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form action="{{ route('categorias.destroy', $c['idCategoria']) }}"
                                          method="POST"
                                          style="display:inline-block;"
                                          onsubmit="return confirm('¿Eliminar esta categoría?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center mb-0">No hay categorías registradas.</div>
            @endif
        </div>
    </div>



</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
</footer>

</body>
</html>