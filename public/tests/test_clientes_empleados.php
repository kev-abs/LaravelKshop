<?php

require_once __DIR__ . '/../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "<h1>PRUEBAS UNITARIAS K-SHOP</h1>";
echo "<hr>";


//MOSTRAR RESULTADO

function mostrarResultado($codigo, $descripcion, $resultado)
{
    if ($resultado) {
        echo "<p style='color:green;font-weight:bold;font-size:18px;'>
        $codigo - $descripcion → APROBADA +
        </p>";
    } else {
        echo "<p style='color:red;font-weight:bold;font-size:18px;'>
        $codigo - $descripcion → FALLIDA -
        </p>";
    }
}



//PRUEBA 1: TOTAL CLIENTES

function testTotalClientes()
{
    try {
        $total = DB::table('cliente')->count();
        return is_numeric($total);
    } catch (Exception $e) {
        return false;
    }
}

mostrarResultado(
    "PU-CLI-01",
    "Obtener total clientes",
    testTotalClientes()
);



//PRUEBA 2: CLIENTE MÁS FRECUENTE

function testClienteFrecuente()
{
    try {
        $cliente = DB::table('cliente')
            ->orderByDesc('total_logins')
            ->first();

        return $cliente != null;

    } catch (Exception $e) {
        return false;
    }
}

mostrarResultado(
    "PU-CLI-02",
    "Cliente más frecuente",
    testClienteFrecuente()
);



//PRUEBA 3: LISTADO EMPLEADOS

function testListadoEmpleados()
{
    try {
        $empleados = DB::table('empleado')->get();
        return $empleados != null;

    } catch (Exception $e) {
        return false;
    }
}

mostrarResultado(
    "PU-EMP-01",
    "Listado empleados",
    testListadoEmpleados()
);



//PRUEBA 4: VALIDAR ESTADO EMPLEADOS

function testEstadoEmpleado()
{
    try {

        $empleados = DB::table('empleado')->get();

        foreach ($empleados as $e) {

            if (!in_array($e->Estado, ['Activo', 'Inactivo', 'Suspendido'])) {
                return false;
            }
        }

        return true;

    } catch (Exception $e) {
        return false;
    }
}

mostrarResultado(
    "PU-EMP-02",
    "Estado empleados válido",
    testEstadoEmpleado()
);


echo "<hr>";
echo "<h2 style='color:blue;'>PRUEBAS FINALIZADAS</h2>";

?>