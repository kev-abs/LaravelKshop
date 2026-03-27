<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Editar Categoría</title>
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
        <h2 class="fw-bold mb-2">Editar Categoría</h2>
        <p class="text-muted">Modifica el nombre de la categoría.</p>
    </div>

    @if($categoria)
        <div class="card shadow-sm border-0 rounded-3 mx-auto" style="max-width: 500px;">
            <div class="card-header bg-dark text-white text-center">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>{{ $categoria['nombre'] }}</h5>
            </div>
            <div class="card-body bg-light p-4">
                <form action="{{ route('categorias.update', $categoria['idCategoria']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre</label>
                        <input type="text" name="nombre" class="form-control"
                               value="{{ $categoria['nombre'] }}" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle me-2"></i>Guardar cambio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">No se encontró la categoría.</div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary btn-lg w-50">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>

</main>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

</body>
</html>