<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'reserva',
        'monto',
        'tipo_pago',
        'estado',
        'fecha_pago',
    ];

    protected $dates = ['fecha_pago'];
    protected $casts = [
        'fecha_pago' => 'datetime',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reserva');
    }
}
