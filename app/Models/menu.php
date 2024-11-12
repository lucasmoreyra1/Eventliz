<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = ['id_user','tipo_menu', 'contenido', 'costo'];

    public $timestamps = true;
}
