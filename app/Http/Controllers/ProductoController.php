<?php

namespace App\Http\Controllers;

// 1. Asegúrate de que el nombre del modelo coincida con el archivo en app/Models
use App\Models\Producto; 
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // 2. Aquí usamos Producto (singular) porque así se llama la clase importada
        $productos = Producto::where('activo', true)->get();
        
        // 3. Enviamos a la vista
        return view('client.index', compact('productos'));
    }

    public function show($id)
{
    // Buscamos el producto por su ID o lanzamos error 404 si no existe
    $producto = Producto::where('id', $id)
    ->where('activo', 1) // Solo mostramos productos activos
    ->firstOrFail(); // Obtenemos el primer resultado (debería ser uno solo por ID
    
    // Retornamos una nueva vista que crearemos en la carpeta client
    return view('client.show', compact('producto'));
}

public function create()
{
    // Necesitamos los insumos para poder armar la receta en el formulario
    $insumos = \App\Models\Insumo::all();
    return view('admin.productos.create', compact('insumos'));
}

public function store(Request $request)
{
    $request->validate([
        'nombre_producto' => 'required|string|max:150',
        'precio_venta'    => 'required|numeric|min:0',
        'imagen'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->all();

    // Lógica para guardar la imagen en la carpeta public
    if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        $destinationPath = 'img/productos/';
        $filename = time() . '-' . $file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
        $data['imagen_url'] = $destinationPath . $filename;
    }

    $producto = Producto::create($data);

    return redirect()->back()->with('success', '✨ ¡Producto "' . $producto->nombre_producto . '" creado con éxito!');
}

}


