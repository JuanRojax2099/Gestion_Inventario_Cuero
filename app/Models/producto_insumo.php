<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class producto_insumo extends Model
{
      use HasFactory;
#Tablas de mi base de datos.
    protected $table ='producto_insumo';
#Creación de valores guia 5 diseño cliente servidor.
    protected $fillable =[
        'producto_id',
        'insumo_id',
    ];

    /**
     * Constructor privado basado en los atributos fillable. GUIA 6 ARQUITECTURA Y DISEÑO
     */
    private function constructor(): void
    {
        foreach ($this->fillable as $attribute) {
            $this->attributes[$attribute] = null;
        }
    }

        #public function GetId($id){return this->$id;}

}
