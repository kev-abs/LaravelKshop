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

                                <button type="submit" class="btn btn-success w-100">
                                    Confirmar pedido
                                </button>

                            </form>

                        </div>
                    </div>

                </div>


                <div class="col-md-4 offset-md-2">

                    <div style="max-height: 75vh; overflow-y: auto; padding-right: 5px;" class="scroll-hidden">


                        <div class="card border-0 shadow-sm rounded-4 mb-3">
                            <div class="card-body">

                                <h6 class="fw-semibold mb-3">
                                    Productos ({{ count($carrito['items']) }})
                                </h6>

                                @foreach ($carrito['items'] as $item)
                                    <div class="mb-3">

                                        <img src="http://35.175.5.116:8080/uploads/productos/{{ $item['imagen'] }}"
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

                        <div class="card border-0 shadow-sm rounded-4">

                            <div class="card-body">

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span>
                                        ${{ number_format($carrito['subtotal'], 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Envío</span>
                                    <span class="text-success">Gratis</span>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total</span>
                                    <span>
                                        ${{ number_format($carrito['subtotal'], 0, ',', '.') }}
                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
