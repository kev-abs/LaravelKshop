<?php

namespace App\Http\Middleware;

use Closure;

class Cliente
{
    public function handle($request, Closure $next)
    {
        if (session('rol') !== 'cliente') {
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
  <title>K-SHOP - Panel cliente</title>

  <!-- Bootstrap y Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      background-color: #ffffff;
      color: #000000;
    }
    body {
      display: flex;
      flex-direction: column;
    }
    main {
      flex: 1;
    }
    .nav-link {
      color: #000000 !important;
      transition: background-color 0.3s, color 0.3s;
    }
    .nav-link:hover {
      color: #ffffff !important;
      background-color: #000000ff;
      border-radius: 0.375rem;
    }
    .nav-link.text-warning:hover {
      background-color: #dc3545;
    }
    .logo-img {
      height: 40px;
      margin-right: 10px;
    }
    .carousel img {
      object-fit: cover;
      height: 500px;
      filter: brightness(85%);
    }
  </style>
</head>
<body>

<!-- ENCABEZADO -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">

    <!-- LOGO -->
    <div class="d-flex align-items-center">
      <img src="{{ asset('img/logo_kshopsinfondo.png') }}" alt="Logo K-Shop" width="83" class="me-2">
      <a class="text-decoration-none fs-7 fw-bold text-dark">K-SHOP</a>
    </div>

    <!-- BARRA DE BÚSQUEDA CENTRADA (invisible en móvil) -->
    <form class="mx-auto d-none d-md-block w-50" action="/buscar" method="GET">
      <input type="text" class="form-control" name="q" placeholder="Buscar productos...">
    </form>

    <!-- MENÚ NAVEGACIÓN -->
    <nav class="d-flex align-items-center gap-3">

      <!-- Perfil cliente -->
      <a href="../perfiles/perfil_cliente.php" class="nav-link text-dark fw-bold"> 
        <i class="bi bi-person-circle me-1"></i>Mi Perfil
      </a>
      <!-- Pedidos -->
       <a href="../php/pedidos.php" class="nav-link text-dark">Pedidos</a>
      <!--Lista de deseos-->
      <a href="../Barra de cliente/lista_de_deseos.php" class="nav-link text-dark">Lista de deseos</a>
      <!--Carrito-->
      <a href="../Barra de navegacion/carrito.php" class="btn btn-outline-dark border-0">
        <i class="bi bi-cart-fill"></i>
      </a>
      <!-- CERRAR SESIÓN-->
      <a href="../php/cerrarsesion.php" class="nav-link">
        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
      </a>
    </nav>
  </div>
</header>

<!-- Panel del Cliente -->
<div class="container mt-5">
  <h2 class="text-center mb-4">Bienvenido a tu Panel de Cliente</h2>

  <h4 class="text-center mt-5 mb-4">Productos que podrían interesarte</h4>

<div class="container">
  <div class="row justify-content-center">

    @forelse ($productos ?? [] as $p)
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
                
                <!-- Imagen -->
               <img 
    src="http://localhost/api/uploads/productos/{{ $p['imagen'] }}"
    class="card-img-top"
    style="height: 180px; object-fit: cover;"
    alt="{{ $p['nombre'] }}"
>


                <!-- Info -->
                <div class="card-body text-center">
                    <h6 class="card-title mb-2">
                        {{ $p['nombre'] }}
                    </h6>

                    <p class="fw-bold mb-3">
                        $ {{ number_format($p['precio'], 0, ',', '.') }}
                    </p>

                    <a href="{{ route('cliente.todosProductos') }}" class="btn btn-outline-dark btn-sm">
                        Ver producto
                    </a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">
            No hay productos para mostrar
        </p>
    @endforelse

  </div>
</div>

<div class="text-center mt-4">
    <a href="{{ route('cliente.todosProductos') }}" class="btn btn-dark px-4">
        Ver todos los productos
    </a>
</div>


</div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../Funciones/funciones.js" defer></script>
</body>
</html>