<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP | Contáctanos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 20px;
        }

        .btn-dark {
            transition: 0.3s;
        }

        .btn-dark:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        footer {
            background-color: #000;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- HEADER -->
<header class="bg-white shadow-sm sticky-top border-bottom py-3">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="70" alt="K-SHOP" class="me-2">
      <a href="/" class="fw-bold text-dark fs-4 text-decoration-none">K-SHOP</a>
    </div>
  </div>
</header>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Card -->
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">

                    <h2 class="text-center fw-bold mb-3">Contáctanos</h2>
                    <p class="text-center text-muted mb-4">
                        ¿Tienes dudas, problemas o sugerencias? Escríbenos y adjunta evidencias si lo necesitas.
                    </p>

                    <!-- ALERTAS -->
                    @if(session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger text-center">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('contacto.enviar') }}" enctype="multipart/form-data" class="row g-4">
                        @csrf

                        <!-- Nombre -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="nombre" class="form-control rounded-3" required>
                        </div>

                        <!-- Correo -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Correo</label>
                            <input type="email" name="correo" class="form-control rounded-3" required>
                        </div>

                        <!-- Tipo -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Tipo de solicitud</label>
                            <select name="tipo" class="form-select rounded-3">
                                <option>Consulta</option>
                                <option>Reclamo</option>
                                <option>Soporte</option>
                                <option>Sugerencia</option>
                            </select>
                        </div>

                        <!-- Mensaje -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Mensaje</label>
                            <textarea name="mensaje" rows="5" class="form-control rounded-3" required></textarea>
                        </div>

                        <!-- Link -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Enlace (opcional)</label>
                            <input type="url" name="link" class="form-control rounded-3" placeholder="https://...">
                        </div>

                        <!-- Archivo -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Adjuntar archivo (opcional)</label>
                            <input type="file" name="archivo" class="form-control rounded-3"
                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                            <small class="text-muted">
                                Puedes subir imágenes, PDF, Word o Excel.
                            </small>
                        </div>

                        <!-- Botón -->
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-dark px-5 py-2 rounded-pill">
                                Enviar mensaje
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="text-white mt-auto pt-4 pb-3">
    <div class="container text-center">
        <h5 class="fw-bold">K-SHOP</h5>
        <p class="small">Moda colombiana con estilo y confianza</p>
        <div class="border-top pt-3 small">
            &copy; 2026 K-SHOP | Todos los derechos reservados
        </div>
    </div>
</footer>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>