<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PedidoController 
{
    public function historial()
    {
        $idCliente = session('id_cliente');

        $response = Http::get("http://35.175.5.116:8080/pedido/cliente/$idCliente");
        $pedidos = $response->json();

        return view('ventas.pedidos.index', compact('pedidos'));
    }

    public function detalle($id)
    {
        $idCliente = session('id_cliente');

        $pedido = Http::get("http://35.175.5.116:8080/pedido/$id")->json();

        if (!$pedido || $pedido['idCliente'] != $idCliente) {
            abort(403);
        }

        $detalles = Http::get("http://35.175.5.116:8080/pedido/$id/detalle")->json();

        return view('ventas.pedidos.detalle', compact('pedido', 'detalles'));
    }

    public function comprobante($id)
    {
        $idCliente = session('id_cliente');

        $pedido = Http::get("http://35.175.5.116:8080/pedido/$id")->json();
        $detalles = Http::get("http://35.175.5.116:8080/pedido/$id/detalle")->json();

        $this->validarComprobante($pedido, $idCliente);

        return view('ventas.pedidos.comprobante', compact('pedido','detalles'));
    }

    public function comprobantePdf($id)
    {
        $idCliente = session('id_cliente');

        $pedido = Http::get("http://35.175.5.116:8080/pedido/$id")->json();
        $detalles = Http::get("http://35.175.5.116:8080/pedido/$id/detalle")->json();

        $this->validarComprobante($pedido, $idCliente);

        $pdf = Pdf::loadView('ventas.pedidos.comprobante', [
            'pedido' => $pedido,
            'detalles' => $detalles
        ]);

        return $pdf->download("Comprobante_Pedido_{$id}.pdf");
    }

    
    private function validarComprobante($pedido, $idCliente)
    {
        // Validar existencia y propiedad del pedido
        if (!$pedido || $pedido['idCliente'] != $idCliente) {
            abort(403);
        }

        // Validar estado de pago
        if (strtoupper($pedido['estadoPago']) !== 'APROBADO') {
            abort(403, 'El comprobante solo está disponible cuando el pago esté aprobado.');
        }
    }

    public function estadisticasVentas(Request $request)
    {
        // 🔎 Filtros
        $inicio = $request->input('fecha_inicio');
        $fin = $request->input('fecha_fin');

        //  Consumir API (TODOS los pedidos)
        $response = Http::get("http://35.175.5.116:8080/pedido");
        $pedidos = $response->json();

        //  Validar si hay datos
        if (!$pedidos) {
            return view('Usuario.panel.reportes.estadisticas_ventas', [
                'totalVentas' => 0,
                'totalPedidos' => 0,
                'totalClientes' => 0,
                'ventasMes' => collect()
            ]);
        }

        //  Filtro por fechas si existen
        if ($inicio && $fin) {
            $pedidos = array_filter($pedidos, function ($p) use ($inicio, $fin) {
                $fecha = date('Y-m-d', strtotime($p['fecha']));
                return $fecha >= $inicio && $fecha <= $fin;
            });
        }

        //  Total ventas
        $totalVentas = array_sum(array_column($pedidos, 'total'));

        //  Total pedidos
        $totalPedidos = count($pedidos);

        //  Clientes únicos
        $clientes = array_unique(array_column($pedidos, 'idCliente'));
        $totalClientes = count($clientes);

        //  Ventas por mes
        $ventasPorMes = [];

        foreach ($pedidos as $p) {
            $mes = date('m', strtotime($p['fecha']));
            if (!isset($ventasPorMes[$mes])) {
                $ventasPorMes[$mes] = 0;
            }
            $ventasPorMes[$mes] += $p['total'];
        }

        // Convertir a colección tipo Laravel
        $ventasMes = collect([]);

        foreach ($ventasPorMes as $mes => $total) {
            $ventasMes->push([
                'mes' => $mes,
                'total' => $total
            ]);
        }

        return view('Usuario.panel.reportes.estadisticas_ventas', compact(
            'totalVentas',
            'totalPedidos',
            'totalClientes',
            'ventasMes'
        ));
    }

    public function productosMasVendidos()
    {
        // Traer pedidos
        $pedidos = Http::get("http://35.175.5.116:8080/pedido")->json();

        if (!$pedidos) {
            return view('Usuario.panel.reportes.productos_mas_vendidos', [
                'productos' => []
            ]);
        }

    
        $ventasProductos = [];

        // Recorrer pedidos
        foreach ($pedidos as $p) {

            $detalles = Http::get("http://35.175.5.116:8080/pedido/{$p['idPedido']}/detalle")->json();

            if ($detalles) {
                foreach ($detalles as $d) {

                    $idProducto = $d['idProducto'];
                    $cantidad = $d['cantidad'];

                    if (!isset($ventasProductos[$idProducto])) {
                        $ventasProductos[$idProducto] = 0;
                    }

                    $ventasProductos[$idProducto] += $cantidad;
                }
            }
        }

        // Ordenar por cantidad
        arsort($ventasProductos);

        // TOP 5
        $ventasProductos = array_slice($ventasProductos, 0, 5, true);

        $productosFinal = [];

        // Obtener info del producto
        foreach ($ventasProductos as $id => $cantidad) {

            $producto = Http::get("http://localhost:8080/productos/{$id}")->json();

            $nombre = $producto['nombre'] ?? "Producto #$id";
            $precio = $producto['precio'] ?? 0;

            $productosFinal[] = [
                'nombre' => $nombre,
                'cantidad' => $cantidad,
                'total' => $cantidad * $precio
            ];
        }

        return view('Usuario.panel.reportes.productos_mas_vendidos', [
            'productos' => $productosFinal
        ]);
    }

    public function clientesFrecuentes()
    {
        $pedidos = Http::get("http://35.175.5.116:8080/pedido")->json();

        if (!$pedidos) {
            return view('Usuario.panel.reportes.clientes_frecuentes', [
                'clientes' => []
            ]);
        }

        $clientesData = [];

        foreach ($pedidos as $p) {

            $id = $p['idCliente'];
            $nombre = $p['nombreCliente'];
            $total = $p['total'];

            if (!isset($clientesData[$id])) {
                $clientesData[$id] = [
                    'nombre' => $nombre,
                    'cantidad' => 0,
                    'total' => 0
                ];
            }

            $clientesData[$id]['cantidad'] += 1;
            $clientesData[$id]['total'] += $total;
        }

        //  ordenar por total gastado
        usort($clientesData, function ($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        //  TOP 5
        $clientesData = array_slice($clientesData, 0, 5);

        return view('Usuario.panel.reportes.clientes_frecuentes', [
            'clientes' => $clientesData
        ]);
    }

    public function efectividadCupones()
    {
        $datos = DB::table('cupon_cliente as cc')
            ->join('cupon as c', 'c.id_cupon', '=', 'cc.ID_Cupon')
            ->select(
                'c.codigo',
                DB::raw('COUNT(cc.ID_Cupon) as asignados'),
                DB::raw('SUM(CASE WHEN cc.Usado = 1 THEN 1 ELSE 0 END) as usados')
            )
            ->groupBy('c.codigo')
            ->get();

        $cupones = [];

        foreach ($datos as $d) {

            $asignados = $d->asignados;
            $usados = $d->usados;

            $porcentaje = $asignados > 0 
                ? round(($usados / $asignados) * 100, 2) 
                : 0;

            $cupones[] = [
                'codigo' => $d->codigo,
                'asignados' => $asignados,
                'usados' => $usados,
                'porcentaje' => $porcentaje
            ];
        }

        // ordenar por más usados
        usort($cupones, function ($a, $b) {
            return $b['usados'] <=> $a['usados'];
        });

        // TOP 5
        $cupones = array_slice($cupones, 0, 5);

        return view('Usuario.panel.reportes.efectividad_cupones', compact('cupones'));
    }
}