<?php

namespace App\Http\Middleware;

use Closure;

class Administrador
{
    public function handle($request, Closure $next)
    {
        if (session('rol') !== 'administrador') {
            return redirect()->route('login');
        }

        return $next($request);
    }
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
<body class="d-flex flex-column min-vh-100">

<!-- ENCABEZADO PANEL ADMIN -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">

    <!-- LOGO -->
    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" class="me-2">
      <a href="{{route('panel.admin')}}" class="text-decoration-none fs-7 fw-bold text-dark">K-SHOP | Admin</a>
    </div>

    <!-- BARRA DE BÚSQUEDA -->
    <form class="mx-auto d-none d-md-block w-50" action="/buscar" method="GET">
      <input type="text" class="form-control" name="q" placeholder="Buscar en el panel...">
    </form>

    <!-- BOTÓN CERRAR SESIÓN -->
    <nav class="d-flex align-items-center gap-3">
      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-dark">
              Cerrar sesión
          </button>
      </form>
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
              <li><a href="{{ route('admin.perfil') }}" class="text-white text-decoration-none">➤ Perfil de Administrador</a></li>
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
              <li><a href="{{ route('empleados.consultar') }}" class="text-white text-decoration-none">➤ Consultar Empleados </a></li>
              <li><a href="{{ route('empleados.agregar') }}" class="text-white text-decoration-none">➤ Registrar Empleados</a></li>
              <li><a href="{{ route('clientes.consultar') }}" class="text-white text-decoration-none">➤ Consultar Clientes</a></li>
              <li><a href="{{ route('clientes.agregar') }}" class="text-white text-decoration-none">➤ Agregar Cliente</a></li>
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
              <li><a href="{{ route('productos.index') }}" class="text-white text-decoration-none">➤ Consultar Productos</a></li>
              <li><a href="{{ route('productos.create') }}" class="text-white text-decoration-none">➤ Agregar Producto</a></li>
              <li><a href="{{ route('productos.productosPorCategoria') }}" class="text-white text-decoration-none">➤ Productos por Categoria</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Inventario -->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white" 
                  type="button" data-bs-toggle="collapse" data-bs-target="#modGestion">
                  Inventario
          </button>
        </h2>

        <div id="modGestion" class="accordion-collapse collapse" data-bs-parent="#accordionModulos">
          <div class="accordion-body">
            <ul class="list-unstyled">

              <!-- PROVEEDORES -->
              <li class="mt-4 mb-2 fw-bold">Proveedores</li>
              <li>
                <a href="{{ route('proveedor.consultar') }}" class="text-white text-decoration-none">➤ Listar proveedores</a>
              </li>
              <li>
                <a href="{{ route('proveedor.agregar') }}" class="text-white text-decoration-none">➤ Agregar proveedor</a>
              </li>
              <li>
                <a href="{{ route('proveedor.editar') }}" class="text-white text-decoration-none">➤ Editar / Eliminar proveedor</a>
              </li>
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
              <li><a href="{{ route('ventas.pedidos') }}" class="text-white text-decoration-none">➤ Consultar Pedido</a></li>
              <li><a href="{{ route('ventas.envios') }}" class="text-white text-decoration-none">➤ Consultar Envío</a></li>
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
              <li><a href="{{ route('reportes.ventas') }}" class="text-white text-decoration-none">➤ Estadísticas de Ventas</a></li>
              <li><a href="{{ route('reportes.productos') }}" class="text-white text-decoration-none">➤ Productos Más Vendidos</a></li>
              <li><a href="{{ route('reportes.clientes') }}" class="text-white text-decoration-none">➤ Clientes Frecuentes</a></li>
              <li><a href="{{ route('productos.inventario', ['filtro' => 'bajo'])}}" class="text-white text-decoration-none">➤ Bajo Inventario</a></li>
              <li><a href="{{ route('exportar.datos') }}" class="text-white text-decoration-none">➤ Exportar Datos</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!--Configuración-->
      <div class="accordion-item bg-dark text-white">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed bg-dark text-white"
                  type="button" data-bs-toggle="collapse" data-bs-target="#modConfigurar">
            Configuración
          </button>
        </h2>
        <div id="modConfigurar" class="accordion-collapse collapse" data-bs-parent="#accordionModulos">
          <div class="accordion-body">
            <ul class="list-unstyled">
              <li><a href="{{ route('empleado.configuracion') }}" class="text-white text-decoration-none">➤ Configurar cuenta </a></li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
  <div class="d-flex justify-content-start ps-3 py-2">
    <button
      class="btn btn-light d-flex align-items-center gap-2 px-3 py-2 rounded-4 shadow-sm menu-btn"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#menuModulos"
    >
      <i class="bi bi-list fs-4"></i>
      <span class="fw-semibold d-none d-md-inline">Menú</span>
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
          <a href="{{ route('usuariosVista') }}" class="text-decoration-none">
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
          <a href="{{ route('productos.index') }}" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0">
              <div class="card-body text-center">
                <i class="bi bi-bag-check fs-1 text-success mb-3"></i>
                <h5 class="card-title fw-bold">Productos</h5>
                <p class="card-text text-muted">Administra el catálogo, actualiza información y controla inventario.</p>
              </div>
            </div>
          </a>
        </div>


        <!-- Card Ventas -->
        <div class="col-md-6 col-lg-3">
          <a href="{{ route('ventas.ventas') }}" class="text-decoration-none">
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

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-auto">
<p class="mb-0">&copy; 2026 K-SHOP</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../Funciones/funciones.js" defer></script>
</body>
</html>
