@extends('ventas.layouts.app')

@section('content')

    <div class="container my-5" style="max-width: 1200px;">

        {{-- FILA 1: TÍTULO --}}
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="fw-semibold mb-0">Carrito</h5>

            </div>
        </div>

        {{--  FILA 2: CONTENIDO --}}
        <div class="row align-items-start">

            {{-- PRODUCTOS --}}
            <div class="col-md-8">

                @if (empty($carrito['items']))
                    <p class="text-muted">Tu carrito está vacío.</p>
                @else
                    <div class="row g-4">
                        @foreach ($carrito['items'] as $item)
                            <div class="col-md-6 item-row" data-id="{{ $item['idProducto'] }}"
                                data-precio="{{ $item['precio'] }}">

                                <div class="card border-0 rounded-4 shadow-sm h-100">

                                    {{-- IMAGEN --}}
                                    <img src="http://35.175.5.116:8080/uploads/productos/{{ $item['imagen'] }}"
                                        class="card-img-top rounded-top-4" style="height:250px; object-fit:cover;">

                                    <div class="card-body">

                                        <div class="fw-semibold" style="font-size:0.9rem;">
                                            {{ $item['nombre'] }}
                                        </div>

                                        <div class="text-muted mb-2" style="font-size:0.85rem;">
                                            ${{ number_format($item['precio'], 0, ',', '.') }}
                                        </div>

                                        {{-- CONTROLES --}}
                                        <div class="d-flex align-items-center gap-2">

                                            <button class="btn btn-sm btn-light border rounded-circle minus"
                                                style="width:30px;height:30px;">-</button>

                                            <span class="fw-semibold item-cantidad">
                                                {{ $item['cantidad'] }}
                                            </span>

                                            <button class="btn btn-sm btn-light border rounded-circle plus"
                                                style="width:30px;height:30px;">+</button>

                                            <button class="btn p-0 border-0 ms-auto delete-btn text-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </div>

                                        {{-- TOTAL --}}
                                        <div class="fw-bold mt-2 item-total">
                                            ${{ number_format($item['total'], 0, ',', '.') }}
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            {{--  RESUMEN --}}
            <div class="col-md-4" style="position: sticky; top: 100px; align-self: flex-start;">

                <div class="card border-0 shadow-sm rounded-3">

                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span id="subtotal">
                                ${{ number_format($carrito['subtotal'], 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Gastos de envío</span>
                            <span class="text-success">Gratis</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold mb-3">
                            <span>Total</span>
                            <span id="total">
                                ${{ number_format($carrito['subtotal'], 0, ',', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('carrito.confirmar') }}" class="btn btn-success w-100">
                            Realizar compra
                        </a>

                    </div>
</div>
            </div>
        </div>

    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const csrfToken = "{{ csrf_token() }}";

            const cuponSelect = document.getElementById('cuponSelect');
            cuponSelect?.addEventListener('change', function() {recalcularSubtotal(); // Recalcula subtotal cuando se cambia el cupón
        });

        const btnComprar = document.getElementById('btnComprar');
        btnComprar?.addEventListener('click', function(e) {
            const cuponSelect = document.getElementById('cuponSelect');
            if(cuponSelect && cuponSelect.value) {
                e.preventDefault(); // detener navegación por un momento
                // redirigir a confirmar con el cupón en la URL
                window.location.href = "{{ route('carrito.confirmar') }}?idCuponClienteAsignado=" + cuponSelect.value + "&descuento=" + cuponSelect.options[cuponSelect.selectedIndex].dataset.descuento;
            }
        });

            document.querySelectorAll(".plus, .minus").forEach(button => {

                button.addEventListener("click", function() {

                    let row = this.closest(".item-row");
                    let idProducto = row.dataset.id;
                    let precio = parseFloat(row.dataset.precio);

                    let cantidadSpan = row.querySelector(".item-cantidad");
                    let totalSpan = row.querySelector(".item-total");

                    let cantidad = parseInt(cantidadSpan.innerText);

                    if (this.classList.contains("plus")) {
                        cantidad++;
                    } else {
                        if (cantidad <= 1) return;
                        cantidad--;
                    }

                    fetch("{{ route('carrito.update') }}", {
                            method: "PUT",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": csrfToken
                            },
                            body: JSON.stringify({
                                idProducto: idProducto,
                                cantidad: cantidad
                            })
                        })
                        .then(() => {

                            cantidadSpan.innerText = cantidad;

                            let nuevoTotal = precio * cantidad;
                            totalSpan.innerText =
                                "$" + nuevoTotal.toLocaleString("es-CO");

                            recalcularSubtotal();
                        });

                });

            });

            document.querySelectorAll(".delete-btn").forEach(button => {

                button.addEventListener("click", function() {

                    let row = this.closest(".item-row");
                    let idProducto = row.dataset.id;

                    fetch("{{ route('carrito.delete') }}", {
                            method: "DELETE",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": csrfToken
                            },
                            body: JSON.stringify({
                                idProducto: idProducto
                            })
                        })
                        .then(() => {
                            row.remove();
                            recalcularSubtotal();
                        });

                });

            });

            function recalcularSubtotal() {

                let subtotal = 0;

                document.querySelectorAll(".item-row").forEach(row => {
                    let precio = parseFloat(row.dataset.precio);
                    let cantidad = parseInt(
                        row.querySelector(".item-cantidad").innerText
                    );
                    subtotal += precio * cantidad;
                });

                // Aplicar descuento si hay cupón activo
                let cuponSelect = document.getElementById('cuponSelect');
                let descuento = 0;
                if(cuponSelect && cuponSelect.value) {
                    descuento = parseFloat(cuponSelect.options[cuponSelect.selectedIndex].dataset.descuento) || 0;
                    subtotal = subtotal * (1 - descuento / 100);
                }

                document.getElementById("subtotal").innerText =
                    "$" + subtotal.toLocaleString("es-CO");

                document.getElementById("total").innerText =
                    "$" + subtotal.toLocaleString("es-CO");
            }

        });
    </script>

@endsection
