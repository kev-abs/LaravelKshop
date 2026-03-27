@extends('layouts.cliente')

@section('title', 'Configuración')

@section('content')

<div class="container mt-4">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="list-group">

                    <button class="list-group-item list-group-item-action active opcion" data-target="perfil">
                    <i class="bi bi-person"></i> Mi información
                    </button>

                    <button class="list-group-item list-group-item-action opcion" data-target="seguridad">
                    <i class="bi bi-shield-lock"></i> Seguridad
                    </button>

                </div>

            </div>
        </div>
    </div>

    <!-- CONTENIDO -->
    <div class="col-md-9">
        <div class="card shadow-sm">
            <div class="card-body">

            <!-- PERFIL -->
            <div class="contenido" id="perfil">
                <h5 class="mb-3">
                    <i class="bi bi-person-lines-fill"></i> Información del cliente
                </h5>

                <div class="row">
                    <div class="col-md-6 mb-2"><strong>ID:</strong> {{ $cliente->ID_Cliente }}</div>
                    <div class="col-md-6 mb-2"><strong>Nombre:</strong> {{ $cliente->Nombre }}</div>
                    <div class="col-md-6 mb-2"><strong>Correo:</strong> {{ $cliente->Correo }}</div>
                    <div class="col-md-6 mb-2"><strong>Documento:</strong> {{ $cliente->Documento }}</div>
                    <div class="col-md-6 mb-2"><strong>Teléfono:</strong> {{ $cliente->Telefono }}</div>
                    <div class="col-md-6 mb-2"><strong>Estado:</strong> {{ $cliente->Estado ?? 'Activo' }}</div>
                </div>

                <hr>

                <div class="text-center">
                    <img src="{{ asset('img/perfilCliente/' . ($cliente->Foto ?? 'default.png')) }}"class="rounded-circle border shadow-sm" width="130">
                </div>

                </div>

                <!-- SEGURIDAD -->
                <div class="contenido d-none" id="seguridad">

                    <h5 class="mb-3">
                        <i class="bi bi-shield-lock"></i> Cambiar contraseña
                    </h5>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('cliente.cambiar.password') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Contraseña actual</label>
                            <input type="password" name="actual" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nueva contraseña</label>
                            <input type="password" name="nueva" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmar contraseña</label>
                            <input type="password" name="confirmar" class="form-control" required>
                        </div>

                        <button class="btn btn-dark w-100">
                            <i class="bi bi-check-circle"></i> Actualizar contraseña
                        </button>

                    </form>

                </div>

                </div>

            </div>
        </div>
    </div>

    </div>
</div>

<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const botones = document.querySelectorAll('.opcion');
    const contenidos = document.querySelectorAll('.contenido');

    botones.forEach(boton => {
        boton.addEventListener('click', () => {

            botones.forEach(btn => btn.classList.remove('active'));
            boton.classList.add('active');

            contenidos.forEach(c => c.classList.add('d-none'));
            document.getElementById(boton.dataset.target).classList.remove('d-none');

        });
    });

});
</script>

@endsection