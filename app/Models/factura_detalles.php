<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\producto;

class factura_detalles extends Model
{
      use HasFactory;
#Tablas de mi base de datos.
    protected $table ='factura_detalles';
#Creación de valores guia 5 diseño cliente servidor.
    protected $fillable =[
        'id_factura',
        'producto',
        'cantidad',
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

    public function factura()
    {
        return $this->belongsTo(factura::class, 'id_factura');
    }

    public function productoRecord()
    {
        return $this->belongsTo(producto::class, 'producto', 'id');
    }

        #public function GetId($id){return this->$id;}

}
