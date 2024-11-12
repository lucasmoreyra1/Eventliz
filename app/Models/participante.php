<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class participante extends Model
{
    use HasFactory;
    protected $table = 'participantes';
    protected $fillable = ['id_evento','nombre', 'apellido', 'telefono', 'email', 'asistencia', 'pago'];

    public $timestamps = true;
}
