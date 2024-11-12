<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evento extends Model
{
    use HasFactory;
    protected $table = 'eventos';
    protected $fillable = ['id_user', 'id_cliente', 'id_tipo', 'nombre', 'descripcion', 'organizador', 'id_menu', 'id_locacion', 'requisitos', 'web', 'fecha_inicio', 'fecha_final', 'hora_inicio', 'hora_final' ,'costo_organizacion','cant_participantes', 'costo_participante', 'presupuesto_evento', 'estado'];

    public $timestamps = true;
}
