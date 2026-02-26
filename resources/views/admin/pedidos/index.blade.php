@extends('admin.layouts.app')

@section('content')



    <div class="container my-5" style="max-width:1200px;">

        <h4 class="fw-semibold mb-4">Gestión de Pedidos</h4>

        @if (empty($pedidos))
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
                            @foreach ($pedidos as $pedido)
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
                                        <form action="{{ route('admin.pedido.estado', $pedido['idPedido']) }}"
                                            method="POST">
                                            @csrf

                                            <select name="estado" class="form-select form-select-sm">
                                                <option value="PENDIENTE"
                                                    {{ $pedido['estado'] == 'PENDIENTE' ? 'selected' : '' }}>Pendiente
                                                </option>
                                                <option value="PAGADO"
                                                    {{ $pedido['estado'] == 'PAGADO' ? 'selected' : '' }}>Pagado</option>
                                                <option value="CANCELADO"
                                                    {{ $pedido['estado'] == 'CANCELADO' ? 'selected' : '' }}>Cancelado
                                                </option>
                                            </select>

                                            <button class="btn btn-sm btn-dark mt-1">
                                                Actualizar
                                            </button>
                                        </form>
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
