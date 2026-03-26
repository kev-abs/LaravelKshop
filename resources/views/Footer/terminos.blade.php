<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-SHOP | Nosotros y Términos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 20px;
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .divider {
            width: 60px;
            height: 4px;
            background: #000;
            margin-bottom: 20px;
        }

        .icon-box i {
            font-size: 22px;
            margin-right: 8px;
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
        <div class="col-lg-10">

            <div class="card shadow-lg border-0">
                <div class="card-body p-5">

                    <!-- HEADER -->
                    <div class="text-center mb-5">
                        <h1 class="fw-bold">K-SHOP</h1>
                        <p class="text-muted">Moda colombiana con identidad, estilo y tecnología</p>
                    </div>

                    <!-- QUIÉNES SOMOS -->
                    <div class="mb-5">
                        <h3 class="section-title">Quiénes somos</h3>
                        <div class="divider"></div>
                        <p class="text-muted">
                            K-SHOP es una plataforma digital de comercio enfocada en la venta de moda moderna, accesible y de alta calidad.
                            Nuestro objetivo es ofrecer una experiencia de compra confiable, rápida y alineada con las tendencias actuales.
                        </p>
                        <p class="text-muted">
                            Integramos tecnología, diseño y servicio al cliente para brindar una experiencia completa,
                            donde cada usuario pueda encontrar productos que representen su estilo personal.
                        </p>
                    </div>

                    <!-- MISIÓN Y VISIÓN -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <h4 class="section-title">Misión</h4>
                            <div class="divider"></div>
                            <p class="text-muted">
                                Ofrecer productos de calidad mediante una plataforma digital eficiente, garantizando seguridad,
                                rapidez y satisfacción en cada compra.
                            </p>
                        </div>

                        <div class="col-md-6">
                            <h4 class="section-title">Visión</h4>
                            <div class="divider"></div>
                            <p class="text-muted">
                                Ser una de las tiendas online de moda más reconocidas en Colombia,
                                destacándonos por innovación, confianza y experiencia de usuario.
                            </p>
                        </div>
                    </div>

                    <!-- VALORES -->
                    <div class="mb-5">
                        <h3 class="section-title">Valores</h3>
                        <div class="divider"></div>

                        <ul class="list-unstyled text-muted">
                            <li class="icon-box"><i class="bi bi-check-circle"></i>Compromiso con la calidad</li>
                            <li class="icon-box"><i class="bi bi-lightning-charge"></i>Innovación constante</li>
                            <li class="icon-box"><i class="bi bi-shield-check"></i>Transparencia y seguridad</li>
                            <li class="icon-box"><i class="bi bi-people"></i>Enfoque en el cliente</li>
                            <li class="icon-box"><i class="bi bi-globe"></i>Responsabilidad digital</li>
                        </ul>
                    </div>

                    <!-- SERVICIOS -->
                    <div class="mb-5">
                        <h3 class="section-title">Qué ofrecemos</h3>
                        <div class="divider"></div>

                        <ul class="list-unstyled text-muted">
                            <li class="icon-box"><i class="bi bi-bag"></i>Catálogo dinámico de productos</li>
                            <li class="icon-box"><i class="bi bi-truck"></i>Envíos a nivel nacional</li>
                            <li class="icon-box"><i class="bi bi-credit-card"></i>Pagos seguros</li>
                            <li class="icon-box"><i class="bi bi-box-seam"></i>Seguimiento de pedidos</li>
                            <li class="icon-box"><i class="bi bi-headset"></i>Soporte personalizado</li>
                        </ul>
                    </div>

                    <!-- TÉRMINOS -->
                    <div class="mb-4">
                        <h3 class="section-title">Términos y Condiciones</h3>
                        <div class="divider"></div>

                        <ul class="text-muted">
                            <li>Los productos están sujetos a disponibilidad.</li>
                            <li>Los precios pueden modificarse sin previo aviso.</li>
                            <li>El usuario es responsable de la seguridad de su cuenta.</li>
                            <li>K-SHOP no se responsabiliza por el uso indebido de la plataforma.</li>
                            <li>Las devoluciones están sujetas a políticas internas.</li>
                        </ul>
                    </div>

                    <!-- CIERRE -->
                    <div class="text-center mt-5">
                        <p class="fw-semibold">
                            K-SHOP integra moda, tecnología y confianza en una sola experiencia digital.
                        </p>
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
        <p class="small">Estilo, confianza y tecnología</p>
        <div class="border-top pt-3 small">
            &copy; 2026 K-SHOP | Todos los derechos reservados
        </div>
    </div>
</footer>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>