<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP | Preguntas Frecuentes</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 20px;
        }

        .accordion-button {
            font-weight: 600;
        }

        .accordion-button:not(.collapsed) {
            background-color: #000;
            color: #fff;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .faq-header {
            text-align: center;
            margin-bottom: 30px;
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
        <div class="col-lg-9">

            <!-- Card principal -->
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">

                    <!-- Encabezado -->
                    <div class="faq-header">
                        <h2 class="fw-bold">Preguntas Frecuentes</h2>
                        <p class="text-muted">
                            Resolvemos tus dudas más comunes para que tu experiencia en K-SHOP sea perfecta.
                        </p>
                    </div>

                    <!-- Accordion -->
                    <div class="accordion" id="faqAccordion">

                        <!-- Pregunta 1 -->
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    ¿Cómo puedo hacer un pedido?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Explora nuestros productos, agrégalos al carrito y procede al checkout para completar tu compra de forma segura.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 2 -->
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    ¿Cuánto tarda el envío?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Los envíos en Colombia tardan entre 2 y 5 días hábiles dependiendo de tu ubicación.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 3 -->
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    ¿Puedo cambiar o devolver un producto?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Si, pero son manejadas por correo electrónico, ve a contáctanos y envía tu solicitud.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 4 -->
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    ¿Qué métodos de pago aceptan?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Aceptamos tarjetas de crédito, débito y pagos electrónicos seguros.
                                </div>
                            </div>
                        </div>

                        <!-- Pregunta 5 -->
                        <div class="accordion-item mb-3 border-0 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    ¿Cómo puedo contactar soporte?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Puedes ir a la sección de contacto y enviarnos un mensaje con o sin archivos adjuntos.
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- CTA -->
                    <div class="text-center mt-5">
                        <p class="text-muted">¿No encontraste tu respuesta?</p>
                        <a href="{{ route('contacto') }}" class="btn btn-dark px-4 rounded-pill">
                            Contáctanos
                        </a>
                    </div>

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