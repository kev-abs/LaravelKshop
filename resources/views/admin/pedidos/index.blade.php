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

                    <table class="table table-hover align-middle text-center mb-0">

    <thead class="table-light">
        <tr>
            <th>No.</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
            <th class="text-end">Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($pedidos as $pedido)
            <tr>

                <td class="fw-semibold">
                    {{ $pedido['idPedido'] }}
                </td>

                <td class="fw-medium">
                    {{ $pedido['nombreCliente'] ?? 'Cliente #'.$pedido['idCliente'] }}
                </td>

                <td class="text-muted small">
                    {{ \Carbon\Carbon::parse($pedido['fecha'])->format('d/m/Y H:i') }}
                </td>

                <td class="fw-semibold text-success">
                    ${{ number_format($pedido['total'], 0, ',', '.') }}
                </td>

                <td>
                    <form action="{{ route('admin.pedido.estado', $pedido['idPedido']) }}"
                          method="POST"
                          class="d-flex flex-column align-items-center gap-1">
                        @csrf

                        <select name="estado" class="form-select form-select-sm text-center">
                            <option value="PENDIENTE"
                                {{ $pedido['estado'] == 'PENDIENTE' ? 'selected' : '' }}>
                                Pendiente
                            </option>
                            <option value="PAGADO"
                                {{ $pedido['estado'] == 'PAGADO' ? 'selected' : '' }}>
                                Pagado
                            </option>
                            <option value="CANCELADO"
                                {{ $pedido['estado'] == 'CANCELADO' ? 'selected' : '' }}>
                                Cancelado
                            </option>
                        </select>

                        <button class="btn btn-sm btn-primary px-3">
                            <i class="bi bi-arrow-repeat"></i>
                        </button>
                    </form>
                </td>

                <td class="text-end">
                    <a href="{{ route('admin.pedido.detalle', $pedido['idPedido']) }}"
                       class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye"></i>
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
