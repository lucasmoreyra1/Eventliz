<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $fillable = ['id_user','nombre', 'telefono', 'email'];

    public $timestamps = true;
}
