<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipos_eventos extends Model
{
    use HasFactory;
    protected $table = 'tipos_eventos';
    protected $fillable = ['id_user','evento', 'activo'];

    public $timestamps = true;
}
