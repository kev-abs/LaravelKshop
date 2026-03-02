<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ProductoTest extends TestCase
{
    //php artisan test --filter ProductoTest
    // PU-12 - RF08: Catálogo productos - obtenerProductos() sin filtros
    public function test_obtener_productos_sin_filtros()
    {
        Http::fake([
            'http://localhost:8080/producto' => Http::response([
                ['id_Producto' => 1, 'nombre' => 'Camisa aestetick', 'precio' => 90000, 'stock' => 10],
                ['id_Producto' => 2, 'nombre' => 'Gafas de moda', 'precio' => 45000, 'stock' => 10],
            ], 200),
            'http://localhost:8080/proveedor' => Http::response([], 200),
        ]);

        $response = $this->get(route('productos.index'));

        $response->assertStatus(200);
        $response->assertSee('Camisa aestetick');
        $response->assertSee('Gafas de moda');
    }

    // PU-13 - RF09: Filtrar búsqueda - filtrarProductos() con filtro categoría
    public function test_filtrar_productos_por_categoria()
    {
        Http::fake([
            'http://localhost:8080/productos/filtrar*' => Http::response([
                ['id_Producto' => 1, 'nombre' => 'Camisa aestetick', 'precio' => 90000, 'stock' => 10],
            ], 200),
        ]);

        $response = $this->get(route('productos.buscar', ['idCategoria' => 32]));

        $response->assertStatus(200);
        $response->assertSee('Camisa aestetick');
    }

    // PU-14 - RF10: Registro productos - insertarProducto() con datos válidos
    public function test_insertar_producto_con_datos_validos()
    {
        Http::fake([
            'http://localhost:8080/producto' => Http::response([
                'id_Producto' => 10,
                'nombre' => 'Producto Test',
                'mensaje' => 'Producto creado correctamente'
            ], 200),
            'http://localhost:8080/proveedor' => Http::response([], 200),
        ]);

        $response = $this->post(route('productos.store'), [
            'nombre'      => 'Producto Test',
            'descripcion' => 'Descripción de prueba',
            'precio'      => 80000,
            'stock'       => 15,
            'id_Proveedor' => 1,
            'estado'      => 'Disponible',
        ]);

        $response->assertRedirect(route('productos.index'));
    }

    // PU-15 - RF11: Actualizar productos - actualizarProducto() con ID válido
    public function test_actualizar_producto_con_id_valido()
    {
        Http::fake([
            'http://localhost:8080/producto/actualizar/32' => Http::response([
                'id_Producto' => 32,
                'nombre'      => 'Camisa actualizada',
                'descripcion' => 'Nueva descripción',
                'precio'      => 60000,
                'stock'       => 8,
                'estado'      => 'Disponible',
                'id_Proveedor' => 1
            ], 200),
            'http://localhost:8080/proveedor' => Http::response([], 200),
        ]);

        $response = $this->put(route('productos.update', 32), [
            'nombre'        => 'Camisa aestetick',
            'descripcion'   => 'Nueva descripción',
            'precio'        => 60000,
            'stock'         => 8,
            'id_Proveedor'   => 1,
            'imagen_actual' => 'imagen.jpg',
            'estado'        => 'activo',
        ]);

        $response->assertRedirect(route('productos.index'));
    }
}