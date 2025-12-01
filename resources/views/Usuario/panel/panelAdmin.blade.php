<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Bloqueo para evitar volver con "atrás"
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");

// Validación de sesión
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: /ModeloVistaControlador/index.php?Controller=login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>K-SHOP - Panel Admin</title>

  <!-- Bootstrap y Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>

<!-- ENCABEZADO PANEL ADMIN -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">

    <!-- LOGO -->
    <div class="d-flex align-items-center">
      <img src="/ModeloVistaControlador/Inicio/Public/Imagenes/logo_kshopsinfondo.png" alt="Logo K-Shop" width="83" class="me-2">
      <a href="/ModeloVistaControlador/index.php?Controller=panel&action=manejarPeticion" class="text-decoration-none fs-7 fw-bold text-dark">K-SHOP | Admin</a>
    </div>

    <!-- BARRA DE BÚSQUEDA -->
    <form class="mx-auto d-none d-md-block w-50" action="/buscar" method="GET">
      <input type="text" class="form-control" name="q" placeholder="Buscar en el panel...">
    </form>

    <!-- BOTÓN CERRAR SESIÓN -->
    <nav class="d-flex align-items-center gap-3">
      <a href="/ModeloVistaControlador/Inicio/Controlador/Logueo/CerrarSesion.php" class="btn btn-outline-dark border-0 text-dark">
        Cerrar Sesión
      </a>
    </nav>
  </div>
</header>


<!-- MENÚ LATERAL OFFCANVAS -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="menuModulos">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Módulos</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <div class="accordion accordion-flush" id="accordionModulos">

      <!-- Perfil -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white" 
                  type="button" data-bs-toggle="collapse" data-bs-target="#modPerfil">
            Perfil
          </button>
        </h2>
        <div id="modPerfil" class="accordion-collapse collapse" data-bs-parent="#accordionModulos">
          <div class="accordion-body">
            <ul class="list-unstyled">
              <li><a href="../perfiles/perfil_admin.php" class="text-white text-decoration-none">➤ Perfil de Administrador</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Usuarios -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white" 
                  type="button" data-bs-toggle="collapse" data-bs-target="#modUsuarios">
            Usuarios
          </button>
        </h2>
        <div id="modUsuarios" class="accordion-collapse collapse" data-bs-parent="#accordionModulos">
          <div class="accordion-body">
            <ul class="list-unstyled">
              <li><a href="/ModeloVistaControlador/index.php?Controller=usuarios&action=consultarEmpleados" class="text-white text-decoration-none">➤ Consultar Empleados </a></li>
              <li><a href="/ModeloVistaControlador/index.php?Controller=usuarios&action=agregarEmpleado" class="text-white text-decoration-none">➤ Registrar Empleados</a></li>
              <li><a href="/ModeloVistaControlador/index.php?Controller=usuarios&action=editarEliminarEmpleado" class="text-white text-decoration-none">➤ Actualizar o Eliminar empleados</a></li>
              <li><a href="/ModeloVistaControlador/index.php?Controller=usuarios&action=consultarClientes" class="text-white text-decoration-none">➤ Consultar Clientes</a></li>
              <li><a href="/ModeloVistaControlador/index.php?Controller=usuarios&action=agregarCliente" class="text-white text-decoration-none">➤ Agregar Cliente</a></li>
              <li><a href="/ModeloVistaControlador/index.php?Controller=usuarios&action=editarEliminarCliente" class="text-white text-decoration-none">➤ Actualizar o Eliminar Cliente</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Productos -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white" 
                  type="button" data-bs-toggle="collapse" data-bs-target="#modProductos">
            Productos
          </button>
        </h2>
        <div id="modProductos" class="accordion-collapse collapse" data-bs-parent="#accordionModulos">
          <div class="accordion-body">
            <ul class="list-unstyled">
              <li><a href="/ModeloVistaControlador/index.php?Controller=producto" class="text-white text-decoration-none">➤ Consultar Productos</a></li>
              <li><a href="/ModeloVistaControlador/index.php?Controller=producto&action=actualizarProducto" class="text-white text-decoration-none">➤ Actualizar Producto</a></li>
              <li><a href="/ModeloVistaControlador/index.php?Controller=producto&action=agregarProducto" class="text-white text-decoration-none">➤ Agregar Producto</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Inventario -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white" 
                  type="button" data-bs-toggle="collapse" data-bs-target="#modInventario">
            Inventario
          </button>
        </h2>
        <div id="modInventario" class="accordion-collapse collapse" data-bs-parent="#accordionModulos">
          <div class="accordion-body">
            <ul class="list-unstyled">
              <li><a href="../Inventario/consultar_inventario.php" class="text-white text-decoration-none">➤ Consultar Inventario</a></li>
              <li><a href="../Inventario/actualizar_inventario.php" class="text-white text-decoration-none">➤ Actualizar Inventario</a></li>
              <li><a href="/ModeloVistaControlador/index.php?Controller=inventario&action=consultarIngresoCompra" class="text-white text-decoration-none">➤ Consultar Compra</a></li>
              <li><a href="/ModeloVistaControlador/index.php?Controller=inventario&action=agregarIngresoCompra" class="text-white text-decoration-none">➤ Ingresar Compra</a></li>
              <li><a href="/ModeloVistaControlador/index.php?Controller=inventario&action=editarEliminarIngresoCompra" class="text-white text-decoration-none">➤ Actualizar o Eliminar Compra</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Ventas -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white" 
                  type="button" data-bs-toggle="collapse" data-bs-target="#modVentas">
            Ventas
          </button>
        </h2>
        <div id="modVentas" class="accordion-collapse collapse" data-bs-parent="#accordionModulos">
          <div class="accordion-body">
            <ul class="list-unstyled">
              <li><a href="/ModeloVistaControlador/index.php?Controller=ventas" class="text-white text-decoration-none">➤ Consultar Pedido</a></li>
              <li><a href="/ModeloVistaControlador/index.php?Controller=envios" class="text-white text-decoration-none">➤ Consultar Envío</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Reportes -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white" 
                  type="button" data-bs-toggle="collapse" data-bs-target="#modReportes">
            Reportes
          </button>
        </h2>
        <div id="modReportes" class="accordion-collapse collapse" data-bs-parent="#accordionModulos">
          <div class="accordion-body">
            <ul class="list-unstyled">
              <li><a href="../reportes/estadisticas_ventas.php" class="text-white text-decoration-none">➤ Estadísticas de Ventas</a></li>
              <li><a href="../reportes/exportar_datos.php" class="text-white text-decoration-none">➤ Exportar Datos</a></li>
              <li><a href="../reportes/productos_mas_vendidos.php" class="text-white text-decoration-none">➤ Productos Más Vendidos</a></li>
              <li><a href="../reportes/clientes_frecuentes.php" class="text-white text-decoration-none">➤ Clientes Frecuentes</a></li>
              <li><a href="../reportes/bajo_inventario.php" class="text-white text-decoration-none">➤ Bajo Inventario</a></li>
              <li><a href="../reportes/efectividad_cupones.php" class="text-white text-decoration-none">➤ Uso de Cupones</a></li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
  <div class="d-flex justify-content-start ps-3 py-2 border-bottom">
    <button class="d-flex justify-content-start ps-3 py-2 border-bottom navbar-toggler navbar-dark border-0 bg-dark p-2 rounded"
            type="button" data-bs-toggle="offcanvas" data-bs-target="#menuModulos"
            aria-controls="menuModulos">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>

<!-- PANEL DE ADMINISTRACIÓN -->
<main class="container my-5">
  <div class="row justify-content-center text-center">
    <div class="col-lg-10">
      <h1 class="mb-3 fw-bold">Bienvenido al Panel de Administración de K-SHOP</h1>
      <p class="lead text-secondary mb-5">
        Controla todos los aspectos de la tienda desde un solo lugar. Gestiona usuarios, productos, inventario y ventas de manera eficiente y profesional.
      </p>


      <div class="row g-4">
        <!-- Card Usuarios -->
        <div class="col-md-6 col-lg-3">
          <a href="/ModeloVistaControlador/index.php?Controller=usuarios" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0">
              <div class="card-body text-center">
                <i class="bi bi-people-fill fs-1 text-primary mb-3"></i>
                <h5 class="card-title fw-bold">Usuarios</h5>
                <p class="card-text text-muted">Registra, consulta y administra clientes y empleados de la tienda.</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Card Productos -->
        <div class="col-md-6 col-lg-3">
          <a href="/ModeloVistaControlador/index.php?Controller=producto" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0">
              <div class="card-body text-center">
                <i class="bi bi-bag-check fs-1 text-success mb-3"></i>
                <h5 class="card-title fw-bold">Productos</h5>
                <p class="card-text text-muted">Administra el catálogo, actualiza información y controla inventario.</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Card Inventario -->
        <div class="col-md-6 col-lg-3">
          <a href="/ModeloVistaControlador/index.php?Controller=inventario" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0">
              <div class="card-body text-center">
                <i class="bi bi-box-seam fs-1 text-warning mb-3"></i>
                <h5 class="card-title fw-bold">Inventario</h5>
                <p class="card-text text-muted">Consulta el inventario en tiempo real y mantén actualizada la disponibilidad.</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Card Ventas -->
        <div class="col-md-6 col-lg-3">
          <a href="/ModeloVistaControlador/index.php?Controller=ventas" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0">
              <div class="card-body text-center">
                <i class="bi bi-cart4 fs-1 text-danger mb-3"></i>
                <h5 class="card-title fw-bold">Ventas</h5>
                <p class="card-text text-muted">Accede a estadísticas, promociones y controla los cupones disponibles.</p>
              </div>
            </div>
          </a>
        </div>
      </div>

      <!-- Nota motivacional -->
      <div class="alert alert-light mt-5 shadow-sm rounded-4 border-start border-5 border-success">
        <h4 class="alert-heading fw-bold">¡Tu rol importa!</h4>
        <p class="mb-0 text-secondary">Como administrador, eres el motor que impulsa el crecimiento de K-SHOP. Cada decisión cuenta. ¡Haz que cada clic construya una mejor tienda!</p>
      </div>
    </div>
  </div>
</main>

<footer class="bg-dark text-white text-center py-4 mt-auto">
  <div class="container">
    <div class="mb-3">
      <a href="#" class="text-white me-3">Términos y condiciones</a>
      <a href="#" class="text-white me-3">Política de privacidad</a>
      <a href="#" class="text-white me-3">Ayuda</a>
    </div>
    <p class="mb-0">&copy; 2025 Tienda K-Shop - Todos los derechos reservados</p>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../Funciones/funciones.js" defer></script>
</body>
</html>
