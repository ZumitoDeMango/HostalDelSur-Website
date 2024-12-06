<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stay extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'reserva',
        'habitacion',
        'fecha_inicio',
        'fecha_fin',
        
    ];
    protected $dates = ['fecha_inicio', 'fecha_fin'];
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
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
