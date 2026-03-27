<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos Más Vendidos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<!-- HEADER -->
<header class="bg-white py-3 border-bottom shadow-sm">
    <div class="container">
        <a href="{{ route('panel.admin') }}" class="text-decoration-none d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
            <span class="fw-bold text-dark">K-SHOP | PRODUCTOS MÁS VENDIDOS</span>
        </a>
    </div>
</header>

<div class="container py-5 flex-grow-1">

    <div class="row">

        <!-- 📋 TABLA -->
        <div class="col-md-6">
            <h4 class="mb-3">Top 5 Productos</h4>

            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Ingresos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $p)
                    <tr>
                        <td>{{ $p['nombre'] }}</td>
                        <td>{{ $p['cantidad'] }}</td>
                        <td>$ {{ number_format($p['total'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 📊 GRÁFICA -->
        <div class="col-md-6">
            <h4 class="mb-3 text-center">Ingresos por Producto</h4>
            <canvas id="graficaProductos"></canvas>
        </div>

    </div>

</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

@php
    $nombres = [];
    $totales = [];

    foreach($productos as $p){
        $nombres[] = $p['nombre'];
        $totales[] = $p['total'];
    }
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const nombres = <?php echo json_encode($nombres); ?>;
    const totales = <?php echo json_encode($totales); ?>;

    new Chart(document.getElementById('graficaProductos'), {
        type: 'line',
        data: {
            labels: nombres,
            datasets: [{
                label: 'Ingresos ($)',
                data: totales,
                borderWidth: 3,
                tension: 0.3
            }]
        }
    });
</script>

</body>
</html>