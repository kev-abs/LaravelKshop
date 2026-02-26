@extends('ventas.layouts.app')

@section('content')

    <div class="container my-5" style="max-width: 950px;">

        <h5 class="mb-4 fw-semibold">Carrito</h5>

        @if (empty($carrito['items']))
            <p class="text-muted">Tu carrito está vacío.</p>
        @else
            @foreach ($carrito['items'] as $item)
                <div class="d-flex align-items-center py-4 border-bottom item-row" data-id="{{ $item['idProducto'] }}"
                    data-precio="{{ $item['precio'] }}">

                    {{-- IMAGEN --}}
                    <div style="width: 120px;">
                        @if (!empty($item['imagen']))
                            <img src="http://localhost:8080/uploads/productos/{{ $item['imagen'] }}" class="img-fluid rounded"
                                style="height:120px; object-fit:cover;">
                        @else
                            <img src="{{ asset('img/no-image.png') }}" class="img-fluid rounded"
                                style="height:120px; object-fit:cover;">
                        @endif
                    </div>

                    {{-- INFO --}}
                    <div class="flex-grow-1 ms-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>
                                <div class="fw-medium">
                                    {{ $item['nombre'] }}
                                </div>

                                <div class="text-muted small mt-1">
                                    ${{ number_format($item['precio'], 0, ',', '.') }}
                                </div>
                            </div>

                            {{-- TOTAL PRODUCTO --}}
                            <div class="fw-semibold item-total">
                                ${{ number_format($item['total'], 0, ',', '.') }}
                            </div>

                        </div>

                        {{-- CONTROLES --}}
                        <div class="d-flex align-items-center mt-3 gap-2">

                            <button class="btn btn-sm btn-light border minus" style="width:34px;height:34px;">-</button>

                            <span class="small item-cantidad">
                                {{ $item['cantidad'] }}
                            </span>

                            <button class="btn btn-sm btn-light border plus" style="width:34px;height:34px;">+</button>

                            {{-- ELIMINAR --}}
                            <button class="btn p-0 border-0 ms-3 delete-btn" style="color:#dc3545;">
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>

                    </div>
                </div>
            @endforeach

            <div class="mt-4 pt-4 border-top">
                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-medium">Subtotal</span>
                    <span class="fw-semibold" id="subtotal">
                        ${{ number_format($carrito['subtotal'], 0, ',', '.') }}
                    </span>
                </div>

                <a href="{{ route('carrito.confirmar') }}" class="btn btn-dark w-100 py-2" style="font-size:0.95rem;">
                    Comprar
                </a>
            </div>
        @endif


        <div class="mt-4">
            <a href="{{ route('panel.cliente') }}" class="btn btn-outline-dark btn-sm rounded-pill px-4">
                ← Volver
            </a>
        </div>

    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const csrfToken = "{{ csrf_token() }}";


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

            // ELIMINAR PRODUCTO
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

                document.getElementById("subtotal").innerText =
                    "$" + subtotal.toLocaleString("es-CO");
            }

        });
    </script>

@endsection
