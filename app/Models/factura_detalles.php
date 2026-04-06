<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class factura_detalles extends Model
{
      use HasFactory;
#Tablas de mi base de datos.
    protected $table ='insumos';
#Creación de valores guia 5 diseño cliente servidor.
    protected $fillable =[
        'id_factura',
        'producto',
        'cantidad',
    ];
        #public function GetId($id){return this->$id;}

}
