@extends('ventas.layouts.app')

@section('content')

<div class="container my-5" style="max-width: 1100px;">

    {{-- HEADER EN TARJETA --}}
    <div class="bg-white shadow-sm rounded-4 p-4 mb-4">

        <div class="d-flex justify-content-between align-items-start flex-wrap">

            <div>
                <h5 class="fw-semibold mb-1">
                    Pedido #{{ $pedido['idPedido'] }}
                </h5>

                <div class="text-muted small">
                    {{ \Carbon\Carbon::parse($pedido['fecha'])->format('d/m/Y H:i') }}
                </div>
            </div>

            <div class="fw-semibold" style="font-size:1.2rem;">
                ${{ number_format($pedido['total'], 0, ',', '.') }}
            </div>

        </div>

        {{-- ESTADOS --}}
        <div class="mt-3 d-flex gap-2 flex-wrap small">

            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                Pedido: {{ $pedido['estado'] }}
            </span>

            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                Pago: {{ $pedido['estadoPago'] }}
            </span>

            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                Envío: {{ $pedido['estadoEnvio'] }}
            </span>

        </div>

    </div>


    {{-- ENVÍO Y PAGO --}}
    <div class="row g-4 mb-5">

        {{-- ENVÍO --}}
        <div class="col-md-6">
            <div class="bg-white shadow-sm rounded-4 p-4 h-100">

                <h6 class="fw-semibold mb-3">Información de envío</h6>

                <div class="small text-muted mb-1">Dirección</div>
                <div class="mb-3">
                    {{ $pedido['direccion'] }}
                </div>

                <div class="small text-muted mb-1">Ciudad</div>
                <div>
                    {{ $pedido['ciudad'] }}
                </div>

            </div>
        </div>

        {{-- PAGO --}}
        <div class="col-md-6">
            <div class="bg-white shadow-sm rounded-4 p-4 h-100">

                <h6 class="fw-semibold mb-3">Información de pago</h6>

                <div class="small text-muted mb-1">Método</div>
                <div class="mb-3">
                    {{ $pedido['metodoPago'] }}
                </div>

                <div class="small text-muted mb-1">Estado</div>
                <div>
                    {{ $pedido['estadoPago'] }}
                </div>

            </div>
        </div>

    </div>


    {{-- PRODUCTOS --}}
    <div class="bg-white shadow-sm rounded-4 p-4">

        <h6 class="fw-semibold mb-3">Productos</h6>

        @foreach($detalles as $item)

        <div class="d-flex align-items-center py-3 border-bottom">

            {{-- IMAGEN --}}
            <div style="width: 100px;">
                @if(!empty($item['imagen']))
                    <img src="http://localhost/api/uploads/productos/{{ $item['imagen'] }}"
                         class="img-fluid rounded-3"
                         style="height:100px; object-fit:cover;">
                @else
                    <img src="{{ asset('img/no-image.png') }}"
                         class="img-fluid rounded-3"
                         style="height:100px; object-fit:cover;">
                @endif
            </div>

            {{-- INFO --}}
            <div class="flex-grow-1 ms-4">

                <div class="fw-medium" style="font-size:0.95rem;">
                    {{ $item['nombre'] }}
                </div>

                <div class="text-muted small">
                    Cantidad: {{ $item['cantidad'] }}
                </div>

                <div class="text-muted small">
                    ${{ number_format($item['precioUnitario'], 0, ',', '.') }}
                </div>

            </div>

            {{-- TOTAL --}}
            <div class="fw-medium">
                ${{ number_format($item['total'], 0, ',', '.') }}
            </div>

        </div>

        @endforeach

    </div>


    {{-- BOTÓN VOLVER --}}
    <div class="mt-4">
        <a href="{{ route('checkout.historial') }}"
           class="btn btn-outline-dark btn-sm rounded-pill px-4">
            ← Volver a mis pedidos
        </a>
    </div>

</div>

@endsection
