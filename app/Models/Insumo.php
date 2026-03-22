<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumos';

    // 1. FILLABLE LIMPIO: Solo identidad y precio de venta
    protected $fillable = [
        'nombre_insumo',
        'tipo', 
        'unidad_medida',
        'precio_venta',
    ];

    // --- RELACIONES ---

    public function lotes() {
        // Ordenamos por vencimiento para que el FIFO sea automático
        return $this->hasMany(Lote::class, 'insumo_id')->orderBy('fecha_vencimiento', 'asc');
    }

    // --- SCOPES ---

    public function scopeFlores($query) {
        return $query->where('tipo', 'flor');
    }

    public function scopeMateriales($query) {
        return $query->where('tipo', 'materia_prima');
    }

    // --- LÓGICA DE NEGOCIO: MOTOR FIFO REAL ---

    public function descontarStock($cantidadADescontar) {
        // Obtenemos solo lotes con existencia y que no estén caducados
        $lotesVivos = $this->lotes()
            ->where('cantidad_actual', '>', 0)
            ->where(function($query) {
                $query->whereNull('fecha_vencimiento') // Materiales que no vencen
                      ->orWhere('fecha_vencimiento', '>', now()); // Flores vivas
            })
            ->get();

        foreach ($lotesVivos as $lote) {
            if ($cantidadADescontar <= 0) break;

            if ($lote->cantidad_actual >= $cantidadADescontar) {
                $lote->decrement('cantidad_actual', $cantidadADescontar);
                $cantidadADescontar = 0;
            } else {
                $cantidadADescontar -= $lote->cantidad_actual;
                $lote->update(['cantidad_actual' => 0]);
            }
        }
        
        return $cantidadADescontar == 0; 
    }

    // --- ACCESSORS (LOS MAGOS DEL SISTEMA) ---

    /**
     * Calcula el STOCK TOTAL sumando todos los lotes al vuelo.
     * Uso: $insumo->stock_total
     */
    public function getStockTotalAttribute() {
        return $this->lotes()->sum('cantidad_actual');
    }

    /**
     * Calcula los días restantes del lote más próximo a morir.
     */
    public function getDiasRestantesAttribute()
    {
        if ($this->tipo !== 'flor') return null;

        $proximoVencimiento = $this->lotes()
            ->where('cantidad_actual', '>', 0)
            ->where('fecha_vencimiento', '>', now())
            ->min('fecha_vencimiento');

        if (!$proximoVencimiento) return 0;

        return (int) now()->diffInDays(Carbon::parse($proximoVencimiento), false);
    }
}