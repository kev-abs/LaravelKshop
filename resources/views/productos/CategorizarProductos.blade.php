<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Categorizar Productos</title>

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
        <h2 class="fw-bold mb-2">Categorizar Productos</h2>
        <p class="text-muted">
            Selecciona uno o varios productos para asignarlos a una categoría.
        </p>
    </div>

   <form action="{{ route('productos.asignarCategoria') }}" method="POST">
@csrf

<!-- Selección de categoría -->
<div class="mb-4">
    <label class="form-label fw-bold">Selecciona una categoría</label>
    <select name="idCategoria" class="form-select" required>
        <option value="">-- Selecciona --</option>
        @foreach($categorias as $c)
            <option value="{{ $c['idCategoria'] }}">
                {{ $c['nombre'] }}
            </option>
        @endforeach
    </select>
</div>

<div class="text-end">
    <button type="submit" id="btnAsignar" class="btn btn-dark btn-lg">
    <i class="bi bi-check2-circle me-2"></i>
    Asignar categoría
</button>
</div>
@if(isset($productos) && count($productos) > 0)

<div class="card shadow-sm border-0 rounded-3 mb-4">
    <div class="card-header bg-dark text-white text-center">
        <h5 class="mb-0">
            <i class="bi bi-tags me-2"></i>Productos disponibles
        </h5>
    </div>

    <div class="card-body bg-light p-4">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center mb-0">

                <thead class="table-secondary">
                    <tr>
                        <th>
                            <input type="checkbox" id="checkAll">
                        </th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($productos as $p)
                    <tr>
                        <td>
                            <input type="checkbox"
                                   name="productos[]"
                                   value="{{ $p['id_Producto'] }}">
                        </td>
                        <td>{{ $p['id_Producto'] }}</td>
                        <td class="fw-semibold">{{ $p['nombre'] }}</td>
                        <td>{{ $p['descripcion'] }}</td>
                        <td>
                            @if ($p['imagen'])
                                <img src="http://35.175.5.116:8080/uploads/productos/{{ $p['imagen'] }}"
                                     width="70"
                                     class="img-thumbnail">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>


@else
<div class="alert alert-warning text-center">
    No hay productos disponibles para categorizar.
</div>
@endif

</form>

</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
</footer>

 <!-- SCRIPT PARA ASIGNAR CATEGORÍAS -->
    <script>
    document.getElementById('btnAsignar').addEventListener('click', async () => {

        const categoria = document.querySelector('select[name="idCategoria"]').value;
        const productos = Array.from(
            document.querySelectorAll('input[name="productos[]"]:checked')
        ).map(cb => cb.value);

        if (!categoria || productos.length === 0) {
            // En vez de alert, puedes usar un return silencioso o mostrar algo en pantalla si quieres
            return;
        }

        try {
            await fetch('http://localhost:8080/api/producto-categoria/asignar-multiple', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    idCategoria: parseInt(categoria),
                    productos: productos.map(Number)
                })
            });

            // Redirigir directamente a productos.index
            window.location.href = "{{ route('productos.index') }}";

        } catch (error) {
            console.error(error);
            // Si quieres, aquí puedes redirigir igual aunque haya error
            // window.location.href = "{{ route('productos.index') }}";
        }
    });
</script>


</body>
</html>
