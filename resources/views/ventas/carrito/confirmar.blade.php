@extends('ventas.layouts.app')

@section('content')

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="container my-5" style="max-width: 1100px;">

        <h5 class="mb-4 fw-semibold">Confirmar compra</h5>

        <div class="row">

            {{-- RESUMEN PRODUCTOS --}}
            <div class="col-md-7">
                @foreach ($carrito['items'] as $item)
                    <div class="d-flex align-items-center py-3 border-bottom">

                        <div style="width: 90px;">
                            @if (!empty($item['imagen']))
                                <img src="http://localhost:8080/uploads/productos/{{ $item['imagen'] }}"
                                    class="img-fluid rounded" style="height:90px; object-fit:cover;"
                                    alt="{{ $item['nombre'] }}">
                            @else
                                <img src="{{ asset('img/no-image.png') }}" class="img-fluid rounded"
                                    style="height:90px; object-fit:cover;" alt="Sin imagen">
                            @endif
                        </div>

                        <div class="flex-grow-1 ms-3">
                            <div class="fw-medium">{{ $item['nombre'] }}</div>
                            <div class="text-muted small mt-1">Cantidad: {{ $item['cantidad'] }}</div>
                        </div>

                        <div class="fw-medium">
                            ${{ number_format($item['total'], 0, ',', '.') }}
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- PANEL DERECHO --}}
            <div class="col-md-5">
                <div class="border p-4 rounded">

                    {{-- SUBTOTAL --}}
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-medium">Subtotal</span>
                        <span class="fw-semibold">
                            ${{ number_format($carrito['subtotal'], 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- DESCUENTO (solo si hay cupón aplicado) --}}
                    @if(!empty($idCupon) && $descuento > 0)
                        @php
                            $valorDescuento = $carrito['subtotal'] * $descuento / 100;
                            $totalFinal     = $carrito['subtotal'] - $valorDescuento;
                        @endphp

                        <div class="d-flex justify-content-between mb-2 text-success small">
                            <span>Descuento ({{ $descuento }}%)</span>
                            <span>- ${{ number_format($valorDescuento, 0, ',', '.') }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3 fw-bold border-top pt-2">
                            <span>Total</span>
                            <span>${{ number_format($totalFinal, 0, ',', '.') }}</span>
                        </div>
                    @else
                        <div class="d-flex justify-content-between mb-3 fw-bold border-top pt-2">
                            <span>Total</span>
                            <span>${{ number_format($carrito['subtotal'], 0, ',', '.') }}</span>
                        </div>
                    @endif

                    <hr>

                    {{-- SECCIÓN CUPONES --}}
                    <div class="mb-3">
                        <label class="form-label small fw-medium">
                             ¿Tienes un cupón?
                        </label>

                        @if(!empty($idCupon) && $descuento > 0)
                            {{-- CUPÓN ACTIVO --}}
                            <div class="alert alert-success py-2 px-3 d-flex justify-content-between align-items-center mb-0">
                                <span class="small">
                                    Cupón aplicado — <strong>{{ $descuento }}% OFF</strong>
                                </span>
                                <a href="{{ route('carrito.cupon.quitar') }}" class="btn btn-sm btn-outline-danger py-0">✕</a>
                            </div>
                        @else
                            {{-- SELECTOR DE CUPONES --}}
                            @if(isset($cuponesDisponibles) && $cuponesDisponibles->isNotEmpty())
                                <form action="{{ route('carrito.cupon.aplicar') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <select name="ID_CuponCliente" class="form-select form-select-sm" required>
                                            <option value="">Selecciona un cupón...</option>
                                            @foreach($cuponesDisponibles as $cupon)
                                                <option value="{{ $cupon->ID_CuponCliente }}">
                                                    {{ $cupon->codigo }} — {{ $cupon->descuento }}% OFF
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-outline-dark btn-sm">Aplicar</button>
                                    </div>
                                </form>
                            @else
                                <div class="text-muted small">No tienes cupones disponibles</div>
                            @endif
                        @endif
                    </div>

                    <hr>

                    {{-- FORMULARIO CHECKOUT --}}
                    <form action="{{ route('carrito.checkout') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small">Dirección</label>
                            <input type="text" name="direccion" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small">Ciudad</label>
                            <input type="text" name="ciudad" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small">Método de pago</label>
                            <select name="metodoPago" class="form-select">
                                <option value="TARJETA">Tarjeta</option>
                                <option value="NEQUI">Nequi</option>
                                <option value="EFECTIVO">Efectivo</option>
                            </select>
                        </div>

                        {{-- Pasa el cupón activo al controlador --}}
                        <input type="hidden" name="idCuponClienteAsignado" value="{{ $idCupon ?? '' }}">

                        <button type="submit" class="btn btn-dark w-100 py-2" style="font-size:0.9rem;">
                            Confirmar pedido
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection