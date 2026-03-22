<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    public function create()
{
    // 1. Traemos los insumos existentes para que la vista no marque error
    $insumos = \App\Models\Insumo::all(); 

    // 2. Pasamos la variable a la vista
    return view('admin.insumos.create', compact('insumos'));
}

    public function store(Request $request)
    {
        // 1. VALIDACIÓN BLINDADA: 
        // Agregamos 'unique:insumos' para que el nombre sea irrepetible
        $request->validate([
            'nombre_insumo'   => 'required|string|max:100|unique:insumos,nombre_insumo',
            'tipo'            => 'required|in:flor,materia_prima,accesorio',
            'unidad_medida'   => 'required|string',
            'stock_actual'    => 'required|integer|min:0',
            'precio_venta'    => 'required|numeric|min:0', 
        ], [
            // Mensaje personalizado para el Rector
            'nombre_insumo.unique' => '⚠️ Este producto ya existe en el catálogo. ¡No dupliques esfuerzos, Chief!',
        ]);

        // 2. LIMPIEZA: Quitamos espacios accidentales al inicio o final
        $data = $request->all();
        $data['nombre_insumo'] = trim($request->nombre_insumo);

        // 3. GUARDADO: Solo lo que está en $fillable
        Insumo::create($data);

        return redirect()->route('insumos.create')
            ->with('success', '🌸 ¡Insumo registrado correctamente en el catálogo maestro!');
    }
}