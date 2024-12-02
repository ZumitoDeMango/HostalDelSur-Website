<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rooms';
    protected $dates = ['deleted_at'];
    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo(Type::class, 'tipo');
    }
}
