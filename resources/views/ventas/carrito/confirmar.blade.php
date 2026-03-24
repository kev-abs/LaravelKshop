@extends('ventas.layouts.app')

@section('content')
    <style>
        .scroll-hidden::-webkit-scrollbar {
            display: none;
        }

        .scroll-hidden {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <div style="min-height: 85vh;">
        <div class="container mt-3 mb-4" style="max-width: 1200px;">

            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="fw-semibold mb-0 text-center">Confirmar compra</h5>
                </div>
            </div>

            <div class="row">

                {{-- 🧾 FORMULARIO CENTRADO --}}
                <div class="col-md-6 mx-auto">

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">

                            <h6 class="fw-semibold mb-3">Datos de envío</h6>

                            <form action="{{ route('carrito.checkout') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label small">Dirección</label>
                                    <input type="text" name="direccion" class="form-control rounded-3" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small">Ciudad</label>
                                    <input type="text" name="ciudad" class="form-control rounded-3" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label small">Método de pago</label>
                                    <select name="metodoPago" class="form-select rounded-3">
                                        <option value="TARJETA">Tarjeta</option>
                                        <option value="NEQUI">Nequi</option>
                                        <option value="EFECTIVO">Efectivo</option>
                                    </select>
                                </div>

                                {{-- PASAR CUPÓN --}}
                                <input type="hidden" name="idCuponClienteAsignado" value="{{ $idCupon ?? '' }}">

                                <button type="submit" class="btn btn-success w-100">
                                    Confirmar pedido
                                </button>

                            </form>

                        </div>
                    </div>

                </div>

                {{-- 📦 PANEL DERECHO --}}
                <div class="col-md-4 offset-md-2">

                    @php
                        $subtotal = $carrito['subtotal'] ?? 0;
                        $valorDescuento = 0;

                        if(!empty($idCupon) && !empty($descuento)){
                            $valorDescuento = $subtotal * $descuento / 100;
                        }

                        $totalFinal = $subtotal - $valorDescuento;
                    @endphp

                    <div style="max-height: 75vh; overflow-y: auto; padding-right: 5px;" class="scroll-hidden">

                        {{-- 🛒 PRODUCTOS --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-3">
                            <div class="card-body">

                                <h6 class="fw-semibold mb-3">
                                    Productos ({{ count($carrito['items'] ?? []) }})
                                </h6>

                                @foreach ($carrito['items'] ?? [] as $item)
                                    <div class="mb-3">

                                        <img src="http://localhost:8080/uploads/productos/{{ $item['imagen'] }}"
                                            onerror="this.src='{{ asset('img/no-image.png') }}'"
                                            class="img-fluid rounded-3 mb-2"
                                            style="height:140px; width:100%; object-fit:cover;">

                                        <div class="small fw-semibold">
                                            {{ $item['nombre'] }}
                                        </div>

                                        <div class="text-muted small">
                                            Cantidad: {{ $item['cantidad'] }}
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>

                        {{-- 💰 RESUMEN --}}
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body">

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>

                                {{-- DESCUENTO --}}
                                @if($valorDescuento > 0)
                                    <div class="d-flex justify-content-between mb-2 text-success small">
                                        <span>Descuento ({{ $descuento }}%)</span>
                                        <span>- ${{ number_format($valorDescuento, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Envío</span>
                                    <span class="text-success">Gratis</span>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total</span>
                                    <span>${{ number_format($totalFinal, 0, ',', '.') }}</span>
                                </div>

                                <hr>

                                {{-- 🎟 CUPONES --}}
                                <div class="mb-2">

                                    @if(!empty($idCupon) && $valorDescuento > 0)
                                        <div class="alert alert-success py-2 px-3 d-flex justify-content-between align-items-center">
                                            <span class="small">
                                                Cupón aplicado — <strong>{{ $descuento }}% OFF</strong>
                                            </span>
                                            <a href="{{ route('carrito.cupon.quitar') }}" class="btn btn-sm btn-outline-danger">✕</a>
                                        </div>
                                    @else
                                        @if(isset($cuponesDisponibles) && $cuponesDisponibles->isNotEmpty())
                                            <form action="{{ route('carrito.cupon.aplicar') }}" method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <select name="ID_CuponCliente" class="form-select form-select-sm" required>
                                                        <option value="">Cupón...</option>
                                                        @foreach($cuponesDisponibles as $cupon)
                                                            <option value="{{ $cupon['ID_CuponClienteAsignado'] }}">
                                                                {{$cupon['codigo'] }} ({{ $cupon['descuento'] }}%)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button class="btn btn-dark btn-sm">OK</button>
                                                </div>
                                            </form>
                                        @else
                                            <div class="text-muted small">Sin cupones</div>
                                        @endif
                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection