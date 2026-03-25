<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes Frecuentes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<!-- HEADER -->
<header class="bg-white py-3 border-bottom shadow-sm">
    <div class="container">
        <a href="{{ route('panel.admin') }}" class="text-decoration-none d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
            <span class="fw-bold text-dark">K-SHOP | CLIENTES FRECUENTES</span>
        </a>
    </div>
</header>

<div class="container py-5 flex-grow-1">

    <div class="row">

        <!-- 📋 TABLA -->
        <div class="col-md-6">
            <h4 class="mb-3">Top 5 Clientes</h4>

            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Cliente</th>
                        <th>Pedidos</th>
                        <th>Total Gastado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $c)
                    <tr>
                        <td>{{ $c['nombre'] }}</td>
                        <td>{{ $c['cantidad'] }}</td>
                        <td>$ {{ number_format($c['total'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 📊 GRÁFICA -->
        <div class="col-md-6">
            <h4 class="mb-3 text-center">Top Clientes</h4>
            <canvas id="graficaClientes"></canvas>
        </div>

    </div>

</div>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <p class="mb-0">&copy; 2025 K-SHOP</p>
</footer>

@php
    $nombres = [];
    $totales = [];

    foreach($clientes as $c){
        $nombres[] = $c['nombre'];
        $totales[] = $c['total'];
    }
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const nombres = <?php echo json_encode($nombres); ?>;
    const totales = <?php echo json_encode($totales); ?>;

    new Chart(document.getElementById('graficaClientes'), {
        type: 'bar',
        data: {
            labels: nombres,
            datasets: [{
                label: 'Total Gastado ($)',
                data: totales,
                borderWidth: 2
            }]
        }
    });
</script>

</body>
</html>