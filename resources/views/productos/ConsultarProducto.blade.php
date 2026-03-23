<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Gestión de Productos</title>
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
        <h2 class="fw-bold mb-2">Gestión de Productos</h2>
        <p class="text-muted">Consulta, agrega y actualiza productos de manera organizada y sencilla.</p>
    </div>

    <!-- Mensajes de éxito o error -->
@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif



    <!-- Botón agregar producto -->
     <div class="d-flex justify-content-center gap-3 mb-4">
    <a href="{{ route('productos.create') }}" class="btn btn-dark btn-lg">
        <i class="bi bi-box-seam me-2"></i>Agregar producto
    </a>
    <a href="{{ route('productos.categorizar') }}" class="btn btn-dark btn-lg">
        <i class="bi bi-tags me-2"></i>Categorizar producto
    </a>
    <a href="{{ route('productos.productosPorCategoria') }}" class="btn btn-dark btn-lg">
        <i class="bi bi-tags me-2"></i>Categorías
    </a>
</div>

    <!-- Tabla de productos -->
    @if(isset($productos) && count($productos) > 0)

        <div class="card shadow-sm border-0 rounded-3 mb-5">
            <div class="card-header bg-dark text-white text-center rounded-top py-2">
                <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i>Listado de Productos</h5>
            </div>

            <div class="card-body bg-light p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center mb-0">

                        <thead class="table-secondary text-dark">
                            <tr>

                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Proveedor</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Género</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($productos as $p)
                            <tr>
                               <td>{{ $p['id_Producto'] }}</td>
                               <td>{{ $p['nombre'] }}</td>
                               <td>{{ $p['descripcion'] }}</td>
                               <td>${{ $p['precio'] }}</td>
                               <td>{{ $p['stock'] }}</td>
                               <td>
    @php
        $prov = collect($proveedores)->firstWhere('id_Proveedor', $p['id_Proveedor']);
    @endphp
    {{ $prov ? $prov['nombre_Empresa'] : 'Sin proveedor' }}
</td>
                                <td>
                                    @if ($p['imagen'])
                                        <img src="http://35.175.5.116:8080/uploads/productos/{{ $p['imagen'] }}" width="80" alt="Producto">

                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>

                                <td>{{ $p['estado'] }}</td>
                                <td>
    @php
        $g = strtolower($p['genero'] ?? 'unisex');
        $iconos = [
            'hombre'     => ['bi-gender-male',    'text-primary'],
            'mujer'      => ['bi-gender-female',   'text-danger'],
            'accesorios' => ['bi-bag',             'text-warning'],
            'unisex'     => ['bi-gender-ambiguous','text-secondary'],
        ];
        [$icon, $color] = $iconos[$g] ?? $iconos['unisex'];
    @endphp
    <i class="bi {{ $icon }} {{ $color }} me-1"></i>{{ ucfirst($g) }}
</td>

                                <td>
                                    <a href="{{ route('productos.edit', $p['id_Producto']) }}" 
                                    class="btn btn-warning btn-sm"> Editar</a>
                                    <form action="{{ route('productos.destroy', $p['id_Producto']) }}"
                                    method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('¿Estás seguro de que deseas ELIMINAR este producto? Esta acción no se puede deshacer');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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
            No hay productos registrados aún. ¡Agrega nuevos productos para comenzar!
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
