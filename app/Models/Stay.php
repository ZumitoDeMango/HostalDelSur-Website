<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stay extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserva',
        'habitacion',
        'fecha_inicio',
        'fecha_fin',
    ];
    
    function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reserva');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'habitacion');
    }
}
