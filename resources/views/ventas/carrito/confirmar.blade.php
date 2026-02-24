@extends('ventas.layouts.app')

@section('content')

<div class="container my-5" style="max-width: 1100px;">

    <h5 class="mb-4 fw-semibold">Confirmar compra</h5>

    <div class="row">

        {{-- 🛍 RESUMEN PRODUCTOS --}}
        <div class="col-md-7">

            @foreach($carrito['items'] as $item)
            <div class="d-flex align-items-center py-3 border-bottom">

                {{-- IMAGEN --}}
                <div style="width: 90px;">
                    @if(!empty($item['imagen']))
                        <img src="http://localhost:8080/uploads/productos/{{ $item['imagen'] }}" 
                             class="img-fluid rounded"
                             style="height:90px; object-fit:cover;">
                    @else
                        <img src="{{ asset('img/no-image.png') }}"
                             class="img-fluid rounded"
                             style="height:90px; object-fit:cover;"
                             alt="Sin imagen">
                    @endif
                </div>

                {{-- INFO --}}
                <div class="flex-grow-1 ms-3">

                    <div class="fw-medium" style="font-size:0.95rem;">
                        {{ $item['nombre'] }}
                    </div>

                    <div class="text-muted small">
                        Cantidad: {{ $item['cantidad'] }}
                    </div>

                </div>

                {{-- TOTAL --}}
                <div class="fw-medium">
                    ${{ number_format($item['total'], 0, ',', '.') }}
                </div>

            </div>
            @endforeach

        </div>

        {{-- 📦 FORMULARIO CHECKOUT --}}
        <div class="col-md-5">

            <div class="border p-4 rounded">

                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-medium">Subtotal</span>
                    <span class="fw-semibold">
                        ${{ number_format($carrito['subtotal'], 0, ',', '.') }}
                    </span>
                </div>

                <hr>

                <form action="{{ route('carrito.checkout') }}" method="POST">
                    @csrf

                    {{-- Dirección --}}
                    <div class="mb-3">
                        <label class="form-label small">Dirección</label>
                        <input type="text"
                               name="direccion"
                               class="form-control"
                               required>
                    </div>

                    {{-- Ciudad --}}
                    <div class="mb-3">
                        <label class="form-label small">Ciudad</label>
                        <input type="text"
                               name="ciudad"
                               class="form-control"
                               required>
                    </div>

                    {{-- Método de Pago --}}
                    <div class="mb-4">
                        <label class="form-label small">Método de pago</label>
                        <select name="metodoPago"
                                class="form-select">
                            <option value="TARJETA">Tarjeta</option>
                            <option value="NEQUI">Nequi</option>
                            <option value="EFECTIVO">Efectivo</option>
                        </select>
                    </div>

                    <button type="submit"
                            class="btn btn-dark w-100 py-2"
                            style="font-size:0.9rem;">
                        Confirmar pedido
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
