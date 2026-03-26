<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>K-SHOP | Ventas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body class="d-flex flex-column min-vh-100">


    @include('ventas.layouts.header')


    <main class="container my-4 flex-grow-1">
        @yield('content')
    </main>


    @include('ventas.layouts.footer')

</body>

</html>
