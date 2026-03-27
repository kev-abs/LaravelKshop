<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas de Ventas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<!-- 🔝 HEADER -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center">
      <!-- 🔙 CLICK PARA VOLVER AL PANEL -->
      <a class="d-flex align-items-center text-decoration-none" href="{{ route('panel.admin') }}">
        <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="83" class="me-2">
        <span class="fw-bold text-dark">K-SHOP | ESTADÍSTICAS DE VENTAS</span>
      </a>
    </div>

  </div>
</header>

<!--  CONTENIDO -->
<div class="container py-5 flex-grow-1">

    <h2 class="mb-4 text-center"> Reporte de Ventas</h2>

    <!--  FILTRO -->
    <form method="GET" action="{{ url('/admin/reportes/ventas') }}" class="row mb-4 justify-content-center">

        <div class="col-md-3">
            <label>Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
        </div>

        <div class="col-md-3">
            <label>Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button class="btn btn-success w-100">Filtrar</button>
        </div>

    </form>

    <!--  CARDS -->
    <div class="row mb-5 text-center">

        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="text-success">Total Ventas</h5>
                    <h3>$ {{ number_format($totalVentas ?? 0, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="text-primary">Total Pedidos</h5>
                    <h3>{{ $totalPedidos ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="text-warning">Clientes Únicos</h5>
                    <h3>{{ $totalClientes ?? 0 }}</h3>
                </div>
            </div>
        </div>

    </div>

    <!--    GRÁFICA -->
    <div class="card shadow p-4">
        <h5 class="text-center mb-3">Ventas por Mes</h5>
        <canvas id="graficaVentas"></canvas>
    </div>

</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

<!-- 🔧 DATOS -->
@php
    $meses = [];
    $ventas = [];

    if(isset($ventasMes)){
        foreach($ventasMes as $item){
            $meses[] = $item['mes'];
            $ventas[] = $item['total'];
        }
    }
@endphp

<!--  CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const meses = <?php echo json_encode($meses); ?>;
    const ventas = <?php echo json_encode($ventas); ?>;

    if (meses.length > 0) {
        new Chart(document.getElementById('graficaVentas'), {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Ventas ($)',
                    data: ventas,
                    borderWidth: 3,
                    tension: 0.3
                }]
            }
        });
    }
</script>

</body>
</html>