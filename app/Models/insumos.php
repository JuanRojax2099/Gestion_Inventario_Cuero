<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class insumos extends Model
{
    use HasFactory;
#Tablas de mi base de datos.
    protected $table ='insumos';

    protected $fillable =[
        'id',
        'nombre',
        'unidad',
        'cantidad',
        'categoria',
        'proveedor'

    ];
}
