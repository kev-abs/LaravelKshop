<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Actualizar Producto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-start align-items-center">
         <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" class="me-2">
        <span class="fw-bold text-dark">K-SHOP | Admin</span>
    </div>
</header>

<main class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold">Actualizar Producto</h2>
        <p class="text-muted">Modifica los datos del producto seleccionado.</p>
    </div>

    @if(session('mensaje'))
        <div class="alert alert-info">
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="col-md-8 mx-auto">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Formulario de Actualización</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('productos.update', $producto['id_Producto']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">ID del Producto</label>
                        <input type="number" class="form-control" value="{{ $producto['id_Producto'] }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $producto['nombre'] }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3" required>{{ $producto['descripcion'] }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio</label>
                            <input type="number" name="precio" class="form-control" value="{{ $producto['precio'] }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" value="{{ $producto['stock'] }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ID Proveedor</label>
                        <input type="number" name="idProveedor" class="form-control" value="{{ $producto['id_Proveedor'] }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="Disponible" {{ $producto['estado'] === 'Disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="Inactivo" {{ $producto['estado'] === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>


                    {{-- IMAGEN ACTUAL --}}
                    @if(!empty($producto['imagen']))
                        <div class="mb-3 text-center">
                            <label class="form-label fw-bold">Imagen actual</label><br>

                            <img src="http://localhost/api/uploads/productos/{{ $producto['imagen'] }}"
                                 alt="Imagen del producto"
                                 width="180"
                                 class="img-thumbnail border">
                        </div>
                    @endif

                    {{-- SUBIR NUEVA IMAGEN --}}
                    <div class="mb-3">
                        <label class="form-label">Seleccionar nueva imagen (opcional)</label>
                        <input type="file" name="imagen" class="form-control">
                    </div>

                    <input type="hidden" name="imagen_actual" value="{{ $producto['imagen'] }}">


                    <button type="submit" class="btn btn-primary w-100 mt-3">Actualizar Producto</button>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary btn-lg w-50">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>
    </div>
</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
</footer>

</body>
</html>
