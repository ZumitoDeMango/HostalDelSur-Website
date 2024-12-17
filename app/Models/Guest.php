<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'reserva',
        'rut_o_pasaporte',
        'nombre',
        'correo',
        'fono',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reserva');
    }
}
