<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'fecha_reserva',
        'rut_o_pasaporte',
        'nombre',
        'correo',
        'fono',
        'info_adicional',
        'total_noches',
        'total_precio',
    ];

    protected $dates = ['fecha_reserva'];
    protected $casts = [
        'fecha_reserva' => 'datetime',
    ];
    
    public function stays()
    {
        return $this->hasMany(Stay::class, 'reserva');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'reserva');
    }

    public function guests()
    {
        return $this->hasMany(Guest::class, 'reserva');
    }
}
