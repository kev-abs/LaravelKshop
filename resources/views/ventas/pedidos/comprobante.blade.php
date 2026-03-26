<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        .container {
            width: 700px;
            margin: auto;
        }

        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .title {
            text-align: right;
        }

        .info {
            margin-bottom: 20px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            vertical-align: top;
            padding: 4px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th {
            border-bottom: 2px solid #000;
            text-align: left;
            padding: 8px;
        }

        .table td {
            border-bottom: 1px solid #ccc;
            padding: 8px;
        }

        .text-right {
            text-align: right;
        }

        .total-box {
            width: 250px;
            margin-left: auto;
            margin-top: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
        }

        .total-final {
            font-size: 14px;
            font-weight: bold;
            border-top: 2px solid #000;
            margin-top: 5px;
            padding-top: 8px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #555;
        }
    </style>

</head>

<body onload="window.print()">

    <div class="container">


        <div class="header">
            <table width="100%">
                <tr>
                    <td>
                        <h2>K-SHOP</h2>
                        <div>Tienda Online</div>
                    </td>
                    <td class="title">
                        <h3>COMPROBANTE DE COMPRA</h3>
                        Pedido {{ $pedido['idPedido'] }}<br>
                        {{ \Carbon\Carbon::parse($pedido['fecha'])->format('d/m/Y H:i') }}
                    </td>
                </tr>
            </table>
        </div>

        {{-- INFORMACIÓN --}}
        <div class="info">
            <table>
                <tr>
                    <td width="50%">
                        <strong>Estado del pedido:</strong><br>
                        {{ $pedido['estado'] }}
                    </td>

                    <td width="50%">
                        <strong>Método de pago:</strong><br>
                        {{ $pedido['metodoPago'] }}
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>Dirección:</strong><br>
                        {{ $pedido['direccion'] }}
                    </td>

                    <td>
                        <strong>Ciudad:</strong><br>
                        {{ $pedido['ciudad'] }}
                    </td>
                </tr>
            </table>
        </div>

        {{-- PRODUCTOS --}}
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th class="text-right">Cantidad</th>
                    <th class="text-right">Precio</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalles as $item)
                    <tr>
                        <td>{{ $item['nombre'] }}</td>
                        <td class="text-right">{{ $item['cantidad'] }}</td>
                        <td class="text-right">${{ number_format($item['precioUnitario'], 0, ',', '.') }}</td>
                        <td class="text-right">${{ number_format($item['total'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- TOTAL --}}
        <div class="total-box">
            <div class="total-row total-final">
                <span>Total pagado</span>
                <span>${{ number_format($pedido['total'], 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            Gracias por tu compra<br>
            K-SHOP © {{ date('Y') }}
        </div>

    </div>

</body>

</html>
