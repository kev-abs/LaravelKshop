<?php

namespace App\Http\Controllers\Producto;

use App\Services\ProductoService;
use Illuminate\Http\Request;

class ProductoController
{
    private $productoService;

    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function panelCliente()
{
    $resultado = $this->productoService->obtenerProductos();

    if (!$resultado['success']) {
        $productos = [];
    } else {
        // Convertir a colección, mezclar y tomar 3
        $productos = collect($resultado['data'])
                        ->shuffle()
                        ->take(3);
    }

    return view('Usuario.panel.panelCliente', compact('productos'));
}




    // ================= LISTAR =================
    public function index()
    {
        $resultado = $this->productoService->obtenerProductos();

        $productos = $resultado["success"] ? $resultado["data"] : [];

        return view("productos.ConsultarProducto", compact("productos"));
    }

    // ================= LISTAR PARA CLIENTE =================
    public function catalogo()
{
    $resultadoProductos = $this->productoService->obtenerProductos();

    $productos = $resultadoProductos["success"] ? $resultadoProductos["data"] : [];

    return view("productos.nuestrosproductos", compact("productos"));
}


    // ================= AGREGAR =================
    public function create()
    {
        return view("productos.AgregarProducto");
    }

    public function store(Request $request)
    {
        $resultado = $this->productoService->agregarProducto(
            $request->nombre,
            $request->descripcion,
            $request->precio,
            $request->stock,
            $request->id_Proveedor,
            $request->file("imagen"),
            $request->estado
        );

        if (!$resultado["success"]) {
            return back()->with("error", $resultado["error"]);
        }

       return redirect()->route("productos.index")->with("success", "Producto agregado");
    }

    // ================= EDITAR =================
    public function edit($id)
    {
        $resultado = $this->productoService->obtenerProductoPorId($id);

        if (!$resultado["success"]) {
            return back()->with("error", "No se pudo cargar el producto");
        }

        $producto = $resultado["data"];

        return view("productos.ActualizarProducto", compact("producto"));
    }

    public function update(Request $request, $id)
{
    $resultado = $this->productoService->actualizarProductos(
    $id,
    $request->nombre,
    $request->descripcion,
    $request->precio,
    $request->stock,
    $request->idProveedor,
    $request->file("imagen"),
    $request->imagen_actual,   
    $request->estado
);

    if (!$resultado["success"]) {
        return back()->with("error", $resultado["error"]);
    }

    return redirect()->route("productos.index")->with("success", "Producto actualizado");
}
public function destroy($id)
{
    $resultado = $this->productoService->eliminarProducto($id);

    if (!$resultado['success']) {
        return back()->with("error", "No se pudo eliminar el producto");
    }

    return redirect()->route("productos.index")->with("success", "Producto eliminado correctamente");
}

}
