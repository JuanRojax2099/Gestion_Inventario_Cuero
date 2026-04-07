<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
      use HasFactory;
#Tablas de mi base de datos.
    protected $table ='insumos';
#Creación de valores guia 5 diseño cliente servidor.
    protected $fillable =[
        'detalles',
        'proveedor',
        'fecha'

    ];

    /**
     * Constructor privado basado en los atributos fillable.
     */
    private function constructor(): void
    {
        foreach ($this->fillable as $attribute) {
            $this->attributes[$attribute] = null;
        }
    }

        #public function GetId($id){return this->$id;}

}
