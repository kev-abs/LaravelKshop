<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Uso de Cupones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<!-- HEADER -->
<header class="bg-white py-3 border-bottom shadow-sm">
    <div class="container">
        <a href="{{ route('panel.admin') }}" class="text-decoration-none d-flex align-items-center">
            <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="80" class="me-2">
            <span class="fw-bold text-dark">K-SHOP | USO DE CUPONES</span>
        </a>
    </div>
</header>

<div class="container py-5 flex-grow-1">

    <div class="row">

        <!-- 📋 TABLA -->
        <div class="col-md-6">
            <h4 class="mb-3">Top Cupones</h4>

            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Cupón</th>
                        <th>Asignados</th>
                        <th>Usados</th>
                        <th>% Uso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cupones as $c)
                    <tr>
                        <td>{{ $c['codigo'] }}</td>
                        <td>{{ $c['asignados'] }}</td>
                        <td>{{ $c['usados'] }}</td>
                        <td>{{ $c['porcentaje'] }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 📊 GRÁFICA -->
        <div class="col-md-6">
            <h4 class="mb-3 text-center">Uso de Cupones</h4>
            <canvas id="graficaCupones"></canvas>
        </div>

    </div>

</div>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <p class="mb-0">&copy; 2025 K-SHOP</p>
</footer>

@php
    $codigos = [];
    $usos = [];

    foreach($cupones as $c){
        $codigos[] = $c['codigo'];
        $usos[] = $c['usados'];
    }
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const codigos = <?php echo json_encode($codigos); ?>;
    const usos = <?php echo json_encode($usos); ?>;

    new Chart(document.getElementById('graficaCupones'), {
        type: 'bar',
        data: {
            labels: codigos,
            datasets: [{
                label: 'Veces Usado',
                data: usos,
                borderWidth: 2
            }]
        }
    });
</script>

</body>
</html>