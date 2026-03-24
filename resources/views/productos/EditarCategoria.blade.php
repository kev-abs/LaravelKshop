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
      <a href="{{route('panel.admin')}}" class="text-decoration-none fs-7 fw-bold text-dark">K-SHOP | Admin</a>
    </div>
    </div>
</header>

<main class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Editar Categoría del Producto</h2>
        <p class="text-muted">Cambia la categoría asignada al producto.</p>
    </div>

    @if($productoEncontrado)

        <div class="card shadow-sm border-0 rounded-3 mb-4 mx-auto" style="max-width: 600px;">
            <div class="card-header bg-dark text-white text-center">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>{{ $productoEncontrado['nombre'] }}</h5>
            </div>
            <div class="card-body bg-light p-4">

                <div class="text-center mb-4">
                    @if($productoEncontrado['imagen'])
                        <img src="http://35.175.5.116:8080/uploads/productos/{{ $productoEncontrado['imagen'] }}"
                             width="120" class="img-thumbnail">
                    @else
                        <span class="text-muted">Sin imagen</span>
                    @endif
                </div>

                <form action="{{ route('productos.actualizarCategoria', $productoEncontrado['id_Producto']) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Categoría actual</label>
                        <select name="idCategoria" class="form-select" required>
                            <option value="">-- Selecciona --</option>
                            @foreach($categorias as $c)
                                <option value="{{ $c['idCategoria'] }}"
                                    {{ $categoriaActual == $c['idCategoria'] ? 'selected' : '' }}>
                                    {{ $c['nombre'] }}
                                </option>
                            @endforeach
                        </select>
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
        <div class="alert alert-warning text-center">
            No se encontró el producto.
        </div>
    @endif

    <div class="text-center mt-3">
        <a href="{{ route('productos.productosPorCategoria') }}" class="btn btn-outline-secondary btn-lg w-50">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>

</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
</footer>

</body>
</html>