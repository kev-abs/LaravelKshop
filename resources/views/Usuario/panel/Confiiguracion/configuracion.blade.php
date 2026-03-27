@extends('layouts.admin')

@section('title', 'Configuración')

@section('content')

<div class="row">

<!-- SIDEBAR -->
<div class="col-md-3 mb-3">
<div class="card shadow-sm">
<div class="card-body">

<div class="list-group">

<button class="list-group-item list-group-item-action active opcion" data-target="privacidad">
<i class="bi bi-lock"></i> Privacidad
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

<!-- PRIVACIDAD -->
<div class="contenido" id="privacidad">

<h5 class="mb-3">
<i class="bi bi-person-lines-fill"></i> Información del administrador
</h5>

<div class="row">
<div class="col-md-6 mb-2"><strong>ID:</strong> {{ $admin->ID_Empleado }}</div>
<div class="col-md-6 mb-2"><strong>Nombre:</strong> {{ $admin->Nombre }}</div>
<div class="col-md-6 mb-2"><strong>Correo:</strong> {{ $admin->Correo }}</div>
<div class="col-md-6 mb-2"><strong>Cargo:</strong> {{ $admin->Cargo }}</div>
<div class="col-md-6 mb-2"><strong>Estado:</strong> {{ $admin->Estado }}</div>
<div class="col-md-6 mb-2"><strong>Fecha de contratación:</strong> {{ $admin->Fecha_Contratacion }}</div>
</div>

<hr>

<div class="text-center">
<img src="{{ asset('img/perfiles/' . ($admin->Foto ?? 'default.png')) }}"
class="rounded-circle border shadow-sm" width="130">
</div>

</div>

<!-- SEGURIDAD -->
<div class="contenido d-none" id="seguridad">

<h5 class="mb-3">
<i class="bi bi-shield-lock"></i> Seguridad
</h5>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('empleado.cambiar.password') }}">
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

<!-- MODO OSCURO -->
<div class="contenido d-none" id="modo">

<h5 class="mb-3">
<i class="bi bi-moon"></i> Apariencia
</h5>

<p class="text-muted">Activa o desactiva el modo oscuro en el panel.</p>

<button class="btn btn-dark w-100" onclick="toggleDarkMode()">
<i class="bi bi-moon"></i> Activar / Desactivar
</button>

</div>

</div>
</div>
</div>

</div>

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