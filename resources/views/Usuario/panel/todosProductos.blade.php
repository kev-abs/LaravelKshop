<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Productos - K-Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .text-shadow { text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); }

        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor:pointer;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow:0 10px 20px rgba(0,0,0,0.2);
        }

        .product-card img {
            height:220px;
            object-fit:cover;
        }

        .btn-hover:hover {
            transform: translateY(-3px);
            transition: 0.3s;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- HEADER RESPONSIVE -->
<header class="bg-white sticky-top py-3 border-bottom shadow-sm">
    <div class="container">

        <div class="row align-items-center g-3">

            <!-- LOGO -->
            <div class="col-6 col-md-3 d-flex align-items-center">
                <img src="{{ asset('img/logo_kshopsinfondo.png') }}" width="70" class="me-2">
                <a href="{{ route('inicio') }}" class="text-decoration-none fw-bold text-dark">
                    K-SHOP
                </a>
            </div>

            <!-- BUSCADOR PC -->
            <div class="col-md-6 d-none d-md-block">
                <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex">
                    <input 
                        type="text" 
                        name="nombre"
                        value="{{ request('nombre') }}"
                        class="form-control me-2"
                        placeholder="Buscar productos..."
                    >
                    <button class="btn btn-dark">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <!-- MENÚ -->
            <div class="col-6 col-md-3 d-flex justify-content-end align-items-center gap-2">

                @guest
                <a href="{{ route('login') }}" class="btn btn-outline-dark">
                    <i class="bi bi-person-circle"></i>
                </a>
                @endguest

            </div>

        </div>

        <!-- BUSCADOR MÓVIL -->
        <div class="row mt-3 d-md-none">
            <div class="col-12">
                <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex">
                    <input 
                        type="text" 
                        name="nombre"
                        value="{{ request('nombre') }}"
                        class="form-control me-2"
                        placeholder="Buscar productos..."
                    >
                    <button class="btn btn-dark">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>

<!-- MAIN -->
<main class="container my-5">

    <!-- GRID RESPONSIVE -->
    <div class="row g-4">

    @forelse($productos as $p)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">

            <div class="card h-100 shadow-sm product-card">

                @if(!empty(data_get($p,'imagen')))
                    <img src="http://35.175.5.116:8080/uploads/productos/{{ data_get($p,'imagen') }}"
                         class="card-img-top"
                         alt="{{ data_get($p,'nombre') }}">
                @else
                    <div class="bg-light text-center py-5">Sin imagen</div>
                @endif

                <div class="card-body text-center d-flex flex-column">

                    <h5 class="card-title">
                        {{ data_get($p,'nombre') }}
                    </h5>

                    <p class="card-text text-muted small">
                        {{ data_get($p,'descripcion','') }}
                    </p>

                    <p class="fw-bold">
                        ${{ number_format(data_get($p,'precio',0), 0, ',', '.') }}
                    </p>

                    <p class="mb-2">
                        Stock:
                        @if(data_get($p,'stock',0) <= 0)
                            <span class="text-danger fw-bold">Agotado</span>
                        @else
                            <span class="text-muted">
                                {{ data_get($p,'stock') }}
                            </span>
                        @endif
                    </p>

                    <!-- BOTONES AL FONDO -->
                    <div class="mt-auto">

                        <a href="{{ route('producto.detalle', data_get($p,'id_Producto')) }}"
                           class="btn btn-outline-dark btn-sm w-100 mb-2">
                           Ver Producto
                        </a>

                        <form action="{{ route('cliente.listaDeseos.agregar') }}"
                              method="POST">
                            @csrf

                            <input type="hidden"
                                   name="ID_Producto"
                                   value="{{ data_get($p,'id_Producto') }}">

                            <button type="submit"
                                    class="btn btn-outline-danger btn-sm w-100">
                                <i class="bi bi-heart"></i> Favoritos
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>

    @empty
        <p class="text-center text-muted">No hay productos disponibles</p>
    @endforelse

    </div>

</main>

<!-- FOOTER -->
<footer class="bg-dark text-white pt-5 mt-auto">
  <div class="container text-center text-md-start">
    <div class="row">

      <div class="col-md-4 mb-4">
        <h5>K-SHOP</h5>
        <p>Moda moderna y urbana.</p>
      </div>

      <div class="col-md-3 mb-4">
        <h6 class="fw-bold">Ayuda</h6>
        <ul class="list-unstyled small">
          <li><a href="{{ route('faq') }}" class="text-white text-decoration-none">Preguntas frecuentes</a></li>
          <li><a href="{{ route('contacto') }}" class="text-white text-decoration-none">Contáctanos</a></li>
          <li><a href="{{ route('terminos') }}" class="text-white text-decoration-none">Sobre nosotros</a></li>
        </ul>
      </div>

    </div>

    <div class="text-center border-top pt-3">
      &copy; 2026 K-SHOP
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>