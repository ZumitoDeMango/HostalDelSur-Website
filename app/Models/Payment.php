<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserva',
        'monto',
        'tipo_pago',
        'estado',
        'fecha_pago',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reserva');
    }
}
