@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('checkout.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Dirección de envío</label>
        <input type="text" name="direccion" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Método de pago</label>
        <select name="metodo_pago" class="form-control" required>
            <option value="EFECTIVO">Efectivo</option>
            <option value="TARJETA">Tarjeta</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Tipo de entrega</label>
        <select name="tipo_entrega" class="form-control" required>
            <option value="DELIVERY">Delivery</option>
            <option value="RECOGER">Recoger en tienda</option>
        </select>
    </div>

    <button class="btn btn-primary btn-lg">
        Confirmar compra
    </button>
</form>
