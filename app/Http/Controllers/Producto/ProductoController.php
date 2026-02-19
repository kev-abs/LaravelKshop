<?php

namespace App\Http\Controllers\Producto;

use App\Services\ProductoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


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
      
        $productos = collect($resultado['data'])
                        ->shuffle()
                        ->take(3);
    }

    return view('Usuario.panel.panelCliente', compact('productos'));
}
public function todosProductos(Request $request)
{

    $productos = $this->productoService->obtenerProductos()['data'] ?? []; 
    $categorias = $this->productoService->obtenerCategorias()['data'] ?? [];
   
    $categoriasConProductos = $this->productoService->obtenerCategoriasConProductos(); 

    if (isset($categoriasConProductos['error'])) {
 
        $categoriasConProductos = []; 
    }
   
    $productosBase = collect($productos)->keyBy('id_Producto')->all();
    
    $mapaRelaciones = []; 
    foreach ($categoriasConProductos as $categoria) { 
        $idCategoria = (int) $categoria['idCategoria']; 
        
        if (isset($categoria['productos']) && is_array($categoria['productos'])) {
            foreach ($categoria['productos'] as $productoAnidado) {
                $idProducto = $productoAnidado['id_Producto']; 
                
                if (!isset($mapaRelaciones[$idProducto])) {
                    $mapaRelaciones[$idProducto] = [];
                }
                if (!in_array($idCategoria, $mapaRelaciones[$idProducto])) {
                    $mapaRelaciones[$idProducto][] = $idCategoria;
                }
            }
        }
    }
    
    $productosFinales = collect($productosBase)->map(function ($p) use ($mapaRelaciones) {
        $idProducto = $p['id_Producto'];
        $p['categorias'] = $mapaRelaciones[$idProducto] ?? [];
        return $p;
    })->values()->all();

    $categoriaId = (string) $request->query('categoria'); 

if (!empty($categoriaId)) {
    $productosFinales = collect($productosFinales)
        ->filter(function($p) use ($categoriaId) {
            
            $categoriasProductoString = array_map('strval', $p['categorias']); 
            
            return in_array($categoriaId, $categoriasProductoString);
        })
        ->values()
        ->all();
}

    return view('Usuario.panel.todosProductos', [
        'productos' => $productosFinales,
        'categorias' => $categorias,
        'categoriaId' => $categoriaId,
    ]);
}

public function detalle($id)
{
    $response = Http::get("http://localhost:8080/productos/".$id);

    $producto = $response->json();

    return view('productos.detalleProducto', compact('producto'));
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
    public function vistacatalogo()
    {
        $resultadoProductos = $this->productoService->obtenerProductos();

        $productos = $resultadoProductos["success"] ? $resultadoProductos["data"] : [];

        return view("productos.productosVista", compact("productos"));
    }
public function categorizar()
{
    $productos = $this->productoService->obtenerProductos()['data'] ?? [];
    $categorias = $this->productoService->obtenerCategorias()['data'] ?? [];

    return view('productos.CategorizarProductos', compact('productos', 'categorias'));
}
public function asignarCategoria(Request $request)
{
    $request->validate([
        'idCategoria' => 'required|integer',
        'productos'   => 'required|array|min:1'
    ]);

    $idCategoria = $request->idCategoria;
    $productos   = $request->productos;

    foreach ($productos as $idProducto) {
        $this->productoService->asignarProductoCategoria(
            $idProducto,
            $idCategoria
        );
    }

    return redirect()
        ->route('productos.index')
        ->with('success', 'Productos categorizados correctamente');
}

public function listar(Request $request)
{
    $response = Http::get('http://localhost:8080/productos/filtrar', [

        'nombre' => $request->query('nombre'),
        'idCategoria' => $request->query('idCategoria') 

    ]);

    $productos = $response->json();

    $categorias = $this->productoService->obtenerCategorias()['data'] ?? [];

    $categoriaId = $request->query('categoria');

    return view('Usuario.panel.todosProductos',
        compact('productos','categorias','categoriaId')
    );
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

      // ================= INVENTARIO =================

    public function inventario(Request $request)
    {
        $filtro = $request->get('filtro');

        $query = DB::table('producto');

        if ($filtro == 'bajo') {
            $query->where('Stock', '<', 10)->where('Stock', '>', 0);
        }

        if ($filtro == 'sin') {
            $query->where('Stock', '<=', 0);
        }

        if ($filtro == 'alto') {
            $query->where('Stock', '>=', 10);
        }

        $productos = $query->get();

        $total = DB::table('producto')->count();
        $stockBajo = DB::table('producto')->where('Stock', '<', 10)->where('Stock', '>', 0)->count();
        $sinStock = DB::table('producto')->where('Stock', '<=', 0)->count();
        $stockAlto = DB::table('producto')->where('Stock', '>=', 10)->count();
        $alertas = $stockBajo + $sinStock;

        return view('productos.inventario', compact(
            'total',
            'stockBajo',
            'sinStock',
            'stockAlto',
            'alertas',
            'productos'
        ));
    }
}
