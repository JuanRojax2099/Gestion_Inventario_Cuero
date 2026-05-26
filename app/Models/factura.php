<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\factura_detalles;

class factura extends Model
{
      use HasFactory;
#Tablas de mi base de datos.
    protected $table ='factura';
#Creación de valores guia 5 diseño cliente servidor.
    protected $fillable =[
        'detalles',
        'proveedor',
        'fecha'

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

    public function detalles()
    {
        return $this->hasMany(factura_detalles::class, 'id_factura');
    }

        #public function GetId($id){return this->$id;}

}
