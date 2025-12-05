@extends('layouts.cliente')

@section('content')
<div class="container mt-5">

    <a href="{{ route('cliente.tienda') }}" class="btn btn-outline-secondary mb-4">
        ← Volver
    </a>

    <div class="row">
        @foreach($productos as $p)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="http://localhost/api/uploads/productos/{{ $p['imagen'] }}"
                         class="card-img-top"
                         alt="Producto">

                    <div class="card-body">
                        <h5 class="card-title">{{ $p['nombre'] }}</h5>
                        <p class="text-muted">{{ $p['descripcion'] }}</p>
                        <h4 class="fw-bold text-primary">${{ number_format($p['precio']) }}</h4>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
