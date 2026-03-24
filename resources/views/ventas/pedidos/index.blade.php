@extends('ventas.layouts.app')

@section('content')

    <div class="container my-5" style="max-width: 1100px;">

        <h5 class="mb-4 fw-semibold">Mis pedidos</h5>

        @if (empty($pedidos))
            <p class="text-muted">No tienes pedidos aún.</p>
        @else
            <div class="row g-4">

                @foreach ($pedidos as $pedido)
                    <div class="col-md-6 col-lg-4">
                        <div class="border rounded p-4 h-100 d-flex flex-column justify-content-between">

                            {{-- HEADER --}}
                            <div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-medium small text-muted">
                                        Pedido {{ $pedido['idPedido'] }}
                                    </span>
                                    <span class="small text-muted">
                                        {{ \Carbon\Carbon::parse($pedido['fecha'])->format('d/m/Y') }}
                                    </span>
                                </div>

                                <div class="fw-semibold mb-3">
                                    ${{ number_format($pedido['total'], 0, ',', '.') }}
                                </div>

                                {{-- ESTADOS --}}
                                <div class="d-flex flex-column gap-2 small">

                                    <div>
                                        Pedido:
                                        <span class="badge bg-light text-dark border">
                                            {{ $pedido['estado'] }}
                                        </span>
                                    </div>

                                    <div>
                                        Pago:
                                        <span class="badge bg-light text-dark border">
                                            {{ $pedido['estadoPago'] }}
                                        </span>
                                    </div>

                                    <div>
                                        Envío:
                                        <span class="badge bg-light text-dark border">
                                            {{ $pedido['estadoEnvio'] }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                            {{-- BOTÓN --}}
                            <div class="mt-4">
                                <a href="{{ route('pedido.detalle', $pedido['idPedido']) }}"
                                    class="btn btn-outline-dark w-100 btn-sm">
                                    Ver detalle
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        @endif


    </div>

@endsection
