<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Productos - K-Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        /* Animación de aparición */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Botones hover */
        .btn-hover:hover {
            transform: translateY(-3px);
            transition: transform 0.3s;
        }

        /* Animación de zoom al click */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .product-card.zoomed {
            transform: scale(1.1);
            z-index: 10;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            position: relative;
        }
    </style>
      <!-- ENCABEZADO -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">

    <!-- LOGO -->
    <div class="d-flex align-items-center">
      <img src="/ModeloVistaControlador/Inicio/Public/Imagenes/logo_kshopsinfondo.png" alt="Logo K-Shop" width="83" height="" class="me-2">
      <a href="/ModeloVistaControlador/index.php?Controller=inicio" class="text-decoration-none fs-7 fw-bold text-dark">K-SHOP</a>
    </div>

    <!-- BARRA DE BÚSQUEDA CENTRADA (invisible en móvil) -->
    <form class="mx-auto d-none d-md-block w-50" action="/buscar" method="GET">
      <input type="text" class="form-control" name="q" placeholder="Buscar productos...">
    </form>

    <!-- MENÚ NAVEGACIÓN -->
    <nav class="d-flex align-items-center gap-3">
      <a href="index.php?Controller=productos&action=verProductos" class="nav-link text-dark">Productos</a>
      <a href="./servicios.php" class="nav-link text-dark">Servicios</a>
      <!-- CARRITO -->
      <a href="index.php?Controller=carrito&action=mostrar" class="btn btn-outline-dark border-0">
        <i class="bi bi-cart-fill"></i>
      </a>

      <!-- INICIAR SESIÓN -->
      <a href="index.php?Controller=login" class="btn btn-outline-dark border-0 text-dark">
        <i class="bi bi-person-circle me-1"></i>Iniciar Sesión
      </a>
    </nav>
  </div>
</header>
</head>

<?php if (!empty($productos) && is_array($productos)): ?>
<div class="container my-5">
    <h2 class="text-center mb-5 fw-bold text-shadow">Nuestros Productos</h2>
    <div class="row g-4">
        <?php foreach ($productos as $p): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 fade-in">
            <div class="card h-100 shadow-sm border-0 rounded-3 product-card">
                <?php if(!empty($p['imagen'])): ?>
                <img src="http://localhost/api/uploads/productos/<?= htmlspecialchars($p['imagen']) ?>" 
                     class="card-img-top img-fluid rounded-top" 
                     alt="<?= htmlspecialchars($p['nombre']) ?>">
                <?php else: ?>
                <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                    <span class="text-muted">Sin imagen</span>
                </div>
                <?php endif; ?>
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title fw-bold"><?= htmlspecialchars($p['nombre']) ?></h5>
                    <p class="card-text text-muted small"><?= htmlspecialchars($p['descripcion']) ?></p>
                    <p class="fw-bold h6">$<?= htmlspecialchars($p['precio']) ?></p>
                    <a href="index.php?Controller=carrito&action=agregar&id=<?= $p['id_Producto'] ?>" class="btn btn-primary mt-auto btn-hover">
                        <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php else: ?>
<div class="container my-5">
    <div class="alert alert-warning text-center shadow-sm">
        No hay productos disponibles.
    </div>
</div>
<?php endif; ?>

<div class="container my-4 text-center">
    <a href="index.php" class="btn btn-outline-secondary btn-lg btn-hover">
        <i class="bi bi-arrow-left me-2"></i>Volver al inicio
    </a>
</div>

<!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <div class="mb-3">
                <a href="#" class="text-white me-3">Términos</a>
                <a href="#" class="text-white me-3">Privacidad</a>
                <a href="#" class="text-white">Ayuda</a>
            </div>
            <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Animación de zoom al hacer click
    const cards = document.querySelectorAll('.product-card');
    cards.forEach(card => {
        card.addEventListener('click', () => {
            // Quita la clase zoomed de otras cards
            cards.forEach(c => c.classList.remove('zoomed'));
            // Añade la clase zoomed a la card clickeada
            card.classList.add('zoomed');
        });
    });

    // Clic fuera de la card para quitar zoom
    document.body.addEventListener('click', e => {
        if (!e.target.closest('.product-card')) {
            cards.forEach(c => c.classList.remove('zoomed'));
        }
    });
</script>
</body>
</html>
