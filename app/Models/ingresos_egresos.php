<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingresos_egresos extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    protected $fillable = ['id_evento', 'fecha', 'tipo', 'monto', 'descripcion'];

    public $timestamps = true;
}
