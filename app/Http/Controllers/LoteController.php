<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Insumo;
use App\Models\Lote;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class LoteController extends Controller
{
    public function create()
    {
        $insumos = Insumo::orderBy('nombre_insumo', 'asc')->get();
        return view('admin.lotes.create', compact('insumos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'insumo_id'         => 'required|exists:insumos,id',
            'cantidad_inicial'  => 'required|integer|min:1',
            'costo_unitario'    => 'required|numeric|min:0',
            'precio_venta_lote' => 'required|numeric|min:0',
            'vida_flor_dias'    => 'nullable|integer|min:1',
        ]);

        $insumo = Insumo::findOrFail($request->insumo_id);
        $fechaVencimiento = ($insumo->tipo === 'flor' && $request->vida_flor_dias) 
            ? Carbon::now()->addDays((int)$request->vida_flor_dias) 
            : null;

        Lote::create([
            'insumo_id'         => $request->insumo_id,
            'cantidad_inicial'  => $request->cantidad_inicial,
            'cantidad_actual'   => $request->cantidad_inicial, 
            'costo_unitario'    => $request->costo_unitario,
            'precio_venta_lote' => $request->precio_venta_lote,
            'vida_flor_dias'    => $request->vida_flor_dias,
            'fecha_vencimiento' => $fechaVencimiento,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Lote registrado con éxito.');    
    }

    public function sugerirPrecioIA(Request $request)
    {
        $insumoId = $request->query('insumo_id');
        $costo = $request->query('costo');
        $insumo = Insumo::find($insumoId);
        $nombre = $insumo ? $insumo->nombre_insumo : 'Producto';

        // Llave de tu captura reciente
        $apiKey = 'AIzaSyB_vFN781VLCF1om_gWz81jUqqygtprq2k';
        $prompt = "Eres experto en ventas de flores. Un producto ({$nombre}) cuesta {$costo} pesos. Sugiere un precio de venta para ganar bien. Responde SOLO el número.";

        try {
            // Usamos gemini-1.5-flash en v1 (Estable) para producción
            $response = Http::withOptions(['verify' => false])
                ->timeout(15)
                ->post("https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [['parts' => [['text' => $prompt]]]]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $texto = $data['candidates'][0]['content']['parts'][0]['text'] ?? '0';
                $precioLimpio = preg_replace('/[^0-9.]/', '', $texto);
                return response()->json(['precio' => number_format((float)$precioLimpio, 2, '.', '')]);
            }

            // Si falla la IA, devolvemos un margen manual del 60% para que el usuario no vea error
            return response()->json(['precio' => number_format($costo * 1.6, 2, '.', '')]);

        } catch (Exception $e) {
            return response()->json(['precio' => number_format($costo * 1.6, 2, '.', '')]);
        }
    }
} // Cierre de Clase Correcto