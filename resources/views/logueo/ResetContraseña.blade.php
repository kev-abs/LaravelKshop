<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP - Verificación de seguridad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
<div class="card shadow border-0 rounded-4 p-4" style="max-width: 460px; width: 100%;">
    <!-- HEADER -->
    <div class="text-center mb-3">

        <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="75" class="mb-2">


        <h4 class="fw-bold mb-1">
            Verificación de seguridad
        </h4>

        <small class="text-muted">
            Ingresa el código enviado a tu correo
        </small>
    </div>

    <!-- ALERTA -->
    @if(session('mensaje'))
        <div class="alert alert-danger text-center">
            {{ session('mensaje') }}
        </div>
    @endif

    <!-- ESTADO -->
    <div class="bg-light border rounded-3 p-3 mb-3 text-center">
        <div class="text-muted small">
            Tiempo restante
        </div>

        <div class="fw-bold fs-4" id="contador">
            02:00
        </div>
    </div>

    <!-- FORMULARIO -->
    <form method="POST"
        action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="correo" value="{{ $correo }}">

        <!-- CODIGO -->
        <div class="mb-3">
            <label class="form-label small text-muted">
                Código de verificación
            </label>

            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="bi bi-shield-lock"></i>
                </span>
                <input type="text" class="form-control" name="codigo" required>
            </div>

        </div>



        <!-- CONTRASEÑA -->
        <div class="mb-3">
            <label class="form-label small text-muted">
                Nueva contraseña
            </label>

            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="bi bi-key"></i>
                </span>

                <input type="password" class="form-control" name="contrasena" required>
            </div>
        </div>



        <!-- BOTON ACTUALIZAR -->
        <button class="btn btn-dark w-100 rounded-3 mb-2" id="btnActualizar">
            Actualizar contraseña
        </button>
    </form>


    <!-- REENVIAR -->
    <div class="text-center mt-2">


        <button class="btn btn-outline-dark btn-sm rounded-3" id="btnReenviar" disabled>
            <i class="bi bi-arrow-repeat"></i>
            Reenviar código
        </button>


        <div class="small text-muted mt-2"
            id="mensajeReenvio">
            Podrás reenviar el código cuando expire
        </div>

    </div>

    <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="text-muted text-decoration-none">
            Volver al inicio de sesión
        </a>
    </div>

    <!-- ESTADO EXPIRADO -->
    <div class="text-center mt-3 small text-muted" id="estadoExpirado" style="display:none;">
        El código ha expirado por seguridad
    </div>
</div>



<script>

    let tiempo = 120; // 2 minutos

    let contador = document.getElementById("contador");

    let botonActualizar = document.getElementById("btnActualizar");

    let botonReenviar = document.getElementById("btnReenviar");

    let estadoExpirado = document.getElementById("estadoExpirado");

    let mensajeReenvio = document.getElementById("mensajeReenvio");



    let intervalo = setInterval(function()
    {

        let minutos = Math.floor(tiempo / 60);
        let segundos = tiempo % 60;
        segundos = segundos < 10 ? "0" + segundos : segundos;
        contador.innerHTML = minutos + ":" + segundos;

        if (tiempo <= 0)
        {

            clearInterval(intervalo);
            contador.innerHTML = "Expirado";
            contador.classList.add("text-muted");

            botonActualizar.disabled = true;
            botonActualizar.classList.remove("btn-dark");
            botonActualizar.classList.add("btn-secondary");

            botonReenviar.disabled = false;
            estadoExpirado.style.display = "block";
            mensajeReenvio.innerHTML = "Puedes solicitar un nuevo código";

        }

        tiempo--;

    }, 1000);

    // REENVIAR CODIGO
    botonReenviar.addEventListener("click", function()
    {
        botonReenviar.disabled = true;
        botonReenviar.innerHTML =
            '<span class="spinner-border spinner-border-sm"></span> Enviando...';
        fetch("{{ route('password.enviar.codigo') }}",
        {
            method: "POST",
            headers:
            {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify(
            {
                correo: "{{ $correo }}"
            })
        })
        .then(response => response.json())
        .then(data =>
        {
            location.reload();
        });
    });
</script>
</body>
</html>