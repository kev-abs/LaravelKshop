@extends('admin.layouts.app')

@section('content')



<div class="container my-5" style="max-width:1200px;">

    <h4 class="fw-semibold mb-4">Gestión de Pedidos</h4>

    @if(empty($pedidos))
        <div class="alert alert-warning">
            No hay pedidos registrados.
        </div>
    @else

    <div class="card shadow-sm border-0">
        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th class="text-end">Acción</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pedidos as $pedido)

                    
                        <tr>

                            <td class="fw-semibold">
                                {{ $pedido['idPedido'] }}
                            </td>

                            <td>
                                Cliente #{{ $pedido['idCliente'] }}
                            </td>

                            <td class="text-muted small">
                                {{ \Carbon\Carbon::parse($pedido['fecha'])->format('d/m/Y H:i') }}
                            </td>

                            <td class="fw-medium">
                                ${{ number_format($pedido['total'], 0, ',', '.') }}
                            </td>

                            <td>
                                @if($pedido['estado'] == 'PENDIENTE')
                                    <span class="badge bg-warning text-dark">
                                        PENDIENTE
                                    </span>
                                @elseif($pedido['estado'] == 'PAGADO')
                                    <span class="badge bg-success">
                                        PAGADO
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        {{ $pedido['estado'] }}
                                    </span>
                                @endif
                            </td>

                            <td class="text-end">
                                <a href="{{ route('admin.pedido.detalle', $pedido['idPedido']) }}"
                                   class="btn btn-sm btn-outline-dark">
                                    Ver
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

    @endif

</div>

@endsection
