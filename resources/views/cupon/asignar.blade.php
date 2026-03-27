<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Cupón</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
           <a class="d-flex align-items-center text-decoration-none" href="{{ route('cupon.inventarioVista') }}">
          <img src="{{asset('img/logo_kshopsinfondo.png')}}" alt="Logo K-Shop" width="83" class="me-2">
          <span class="fw-bold text-dark">K-SHOP | Asignar Cupón</span>
        </a>
        </div>
    </div>
</header>

<div class="container py-5 flex-grow-1">
    <h1 class="mb-4 text-center">Asignar Cupón a Cliente</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('cupon.asignar') }}" class="text-center">
        @csrf
        <div class="row justify-content-center mb-4">

    <div class="col-md-4">
        <label class="form-label">Seleccionar Cliente</label>
        <select name="ID_Cliente" class="form-select" required>
            <option value="">-- Seleccione Cliente --</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->ID_Cliente }}">
                    {{ $cliente->Nombre }}
                </option>
            @endforeach
        </select>
    </div>

        <div class="col-md-4">
            <label class="form-label">Seleccionar Cupón</label>
            <select name="ID_Cupon" class="form-select" required>
                <option value="">-- Seleccione Cupón --</option>
                @foreach($cupones as $cupon)
                    <option value="{{ $cupon->ID_Cupon }}">
                        {{ $cupon->Codigo }} - {{ $cupon->Descuento }}%
                    </option>
                @endforeach
            </select>
        </div>

    </div>
        <div class="text-center">
            <button type="submit" class="btn btn-warning px-4">
                <i class="bi bi-ticket-perforated"></i> Asignar Cupón
            </button>
        </div>
    </form>
</div>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <div class="container">
        <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
    </div>
</footer>

</body>
</html>