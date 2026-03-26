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
    $response = Http::get("http://35.175.5.116:8080/productos/".$id);

    $producto = $response->json();

    return view('productos.detalleProducto', compact('producto'));
}




    // ================= LISTAR =================
    public function index()
{
    $resultado = $this->productoService->obtenerProductos();
    $productos = $resultado["success"] ? $resultado["data"] : [];

    $response = Http::get('http://35.175.5.116:8080/proveedor');
    $proveedores = $response->successful() ? $response->json() : [];

    return view("productos.ConsultarProducto", compact("productos", "proveedores"));
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

    // Traer productos ya categorizados
$response = Http::get('http://35.175.5.116:8080/api/producto-categoria/por-categoria');
$categorizados = $response->successful() ? $response->json() : [];


    // Extraer IDs ya categorizados
   $idsCategorizados = collect($categorizados)
    ->flatMap(fn($cat) => collect($cat['productos'])->pluck('id_Producto')) 
    ->toArray();

$productos = collect($productos)->filter(function($p) use ($idsCategorizados) {
    return !in_array($p['id_Producto'], $idsCategorizados); 
})->values()->toArray();
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

public function editarCategoria($id)
{
    $categorias = $this->productoService->obtenerCategorias()['data'] ?? [];

    $response = Http::get('http://35.175.5.116:8080/api/producto-categoria/por-categoria');
    $categorizados = $response->successful() ? $response->json() : [];

    // Buscar el producto y su categoría actual
    $productoEncontrado = null;
    $categoriaActual = null;

    foreach ($categorizados as $cat) {
        foreach ($cat['productos'] as $p) {
            if ($p['idProducto'] == $id) {
                $productoEncontrado = $p;
                $categoriaActual = $cat['idCategoria'];
                break 2;
            }
        }
    }

    return view('productos.EditarCategoria', compact('productoEncontrado', 'categorias', 'categoriaActual'));
}

public function actualizarCategoria(Request $request, $id)
{
    $response = Http::post('http://35.175.5.116:8080/api/producto-categoria/asignar-multiple', [
        'idCategoria' => (int) $request->idCategoria,
        'productos' => [(int) $id]
    ]);

    if ($response->successful()) {
        return redirect()->route('productos.productosPorCategoria')->with('success', 'Categoría actualizada correctamente');
    }

    return back()->with('error', 'No se pudo actualizar la categoría');
}
public function listar(Request $request)
{
    $response = Http::get('http://35.175.5.116:8080/productos/filtrar', [
        'nombre'      => $request->query('nombre'),
        'idCategoria' => $request->query('idCategoria')
    ]);

    $productos = $response->json();

    $categorias = $this->productoService->obtenerCategorias()['data'] ?? [];

    $categoriaId = $request->query('categoria');

    return view('Usuario.panel.todosProductos',
        compact('productos','categorias','categoriaId')
    );
}

// ================= CATEGORÍAS =================
public function gestionCategorias()
{
    $response = Http::get('http://35.175.5.116:8080/api/categorias');
    $categorias = $response->successful() ? $response->json() : [];

    return view('categorias.index', compact('categorias'));
}

public function crearCategoria(Request $request)
{
    $request->validate(['nombre' => 'required|string']);

    Http::post('http://35.175.5.116:8080/api/categorias', [
        'nombre' => $request->nombre
    ]);

    return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente');
}

public function editarCategoriaForm($id)
{
    $response = Http::get('http://35.175.5.116:8080/api/categorias');
    $categorias = $response->successful() ? $response->json() : [];
    $categoria = collect($categorias)->firstWhere('idCategoria', (int)$id);

    return view('categorias.edit', compact('categoria'));
}

public function actualizarCategoriaForm(Request $request, $id)
{
    $request->validate(['nombre' => 'required|string']);

    Http::put("http://35.175.5.116:8080/api/categorias/{$id}", [
        'nombre' => $request->nombre
    ]);

    return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente');
}

public function eliminarCategoria($id)
{
    Http::delete("http://35.175.5.116:8080/api/categorias/{$id}");

    return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente');
}

    // ================= AGREGAR =================
    public function create()
{
    $response = Http::get('http://35.175.5.116:8080/proveedor');
    $proveedores = $response->successful() ? $response->json() : [];

    return view("productos.AgregarProducto", compact("proveedores"));
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
    // producto
    $resultado = $this->productoService->obtenerProductoPorId($id);

    if (!$resultado["success"]) {
        return back()->with("error", "No se pudo cargar el producto");
    }

    $producto = $resultado["data"];

    $response = Http::get('http://35.175.5.116:8080/proveedor');

    $proveedores = $response->successful()
        ? $response->json()
        : [];

    return view("productos.ActualizarProducto",
        compact("producto", "proveedores")
    );
}
    public function update(Request $request, $id)
{
    $resultado = $this->productoService->actualizarProductos(
    $id,
    $request->nombre,
    $request->descripcion,
    $request->precio,
    $request->stock,
    $request->id_Proveedor,
    $request->file("imagen"),
    $request->imagen_actual,   
    $request->estado
);

    if (isset($resultado['error'])) {
    return back()->with("error", $resultado['error']);
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