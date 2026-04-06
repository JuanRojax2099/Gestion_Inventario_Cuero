<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class producto_insumo extends Model
{
      use HasFactory;
#Tablas de mi base de datos.
    protected $table ='insumos';
#Creación de valores guia 5 diseño cliente servidor.
    protected $fillable =[
        'producto_id',
        'insumo_id',
    ];
        #public function GetId($id){return this->$id;}

}
