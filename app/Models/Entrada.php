<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'tipo_entrada',
        'codigo_reserva',
        'telefono_cobro',
        'estado_pago',
    ];

    protected $casts = [
        'estado_pago' => 'boolean',
    ];

    /**
     * Devuelve el precio según el tipo de entrada
     */
    public function getPrecioAttribute()
    {
        return $this->tipo_entrada === 'menu' ? 25 : 15;
    }
}
