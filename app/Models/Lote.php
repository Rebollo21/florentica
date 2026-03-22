<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lote extends Model
{
    protected $table = 'lotes';

    // 1. FILLABLE ACTUALIZADO: Agregamos costo_unitario y quitamos lo innecesario
    protected $fillable = [
        'insumo_id', 
        'cantidad_inicial', 
        'cantidad_actual', 
        'costo_unitario', // 💰 Vital para saber cuánto invertiste
        'vida_flor_dias', 
        'fecha_vencimiento'
    ];

    // 2. CASTS: Para que Laravel trate los datos correctamente
    protected $casts = [
        'fecha_vencimiento' => 'datetime',
        'cantidad_actual'   => 'integer',
        'cantidad_inicial'  => 'integer',
        'costo_unitario'    => 'decimal:2', // 💵 Asegura que siempre tenga 2 decimales
    ];

    // --- RELACIONES ---

    /** Un lote pertenece a un producto del catálogo */
    public function insumo() {
        return $this->belongsTo(Insumo::class, 'insumo_id');
    }

    // --- ACCESSORS (INTELIGENCIA DE NEGOCIO) ---

    /**
     * Calcula la utilidad proyectada de este lote específico.
     * Uso: $lote->utilidad_estimada
     */
    public function getUtilidadEstimadaAttribute() {
        if (!$this->insumo) return 0;
        
        $precioVenta = $this->insumo->precio_venta;
        $utilidadPorUnidad = $precioVenta - $this->costo_unitario;
        
        return $this->cantidad_actual * $utilidadPorUnidad;
    }

    /**
     * Indica si el lote está próximo a vencer (menos de 2 días).
     * Uso: $lote->esta_critico
     */
    public function getEstaCriticoAttribute() {
        if (!$this->fecha_vencimiento) return false;
        return $this->fecha_vencimiento->isPast() || $this->fecha_vencimiento->diffInDays(now()) <= 2;
    }
}