<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class AdminProveedoresModel extends Model
{
    use HasFactory;
                protected $table = "proveedores";
                protected $fillable = ['id', 'nombre', 'direccion', 'telefono'];

}
