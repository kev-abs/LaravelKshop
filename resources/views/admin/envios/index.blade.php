@extends('admin.layouts.app')

@section('content')

<div class="container my-5" style="max-width:1200px;">
    <h4 class="fw-semibold mb-4">Gestión de Envíos</h4>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">

            <table class="table table-hover align-middle text-center mb-0">

                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>ID Pedido</th>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($envios as $envio)
                        <tr>
                            <td class="fw-semibold">
                                {{ $envio['idEnvio'] }}
                            </td>

                            <td>
                                {{ $envio['idPedido'] }}
                            </td>

                            <td>
                                {{ $envio['direccion'] }}
                            </td>

                            <td>
                                {{ $envio['ciudad'] }}
                            </td>

                            <td>
                                <span class="badge 
                                    @if($envio['estado'] == 'PENDIENTE') bg-warning text-dark
                                    @elseif($envio['estado'] == 'ENVIADO') bg-primary
                                    @elseif($envio['estado'] == 'ENTREGADO') bg-success
                                    @endif">
                                    {{ $envio['estado'] }}
                                </span>
                            </td>

                            <td>
                                <form action="{{ route('admin.envio.estado', $envio['idEnvio']) }}"
                                      method="POST" class="d-flex gap-2 justify-content-center">
                                    @csrf
                                    @method('PUT')

                                    <select name="estado" class="form-select form-select-sm">
                                        <option value="PENDIENTE">Pendiente</option>
                                        <option value="ENVIADO">Enviado</option>
                                        <option value="ENTREGADO">Entregado</option>
                                    </select>

                                    <button class="btn btn-sm btn-primary">
                                        <i class="bi bi-truck"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>

@endsection