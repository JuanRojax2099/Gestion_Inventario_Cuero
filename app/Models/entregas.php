<?php
#Todos los modelos son DE Arquitectura cliente servidor.GUIA 5
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#Creación de Setters y getters guia 6 Arquitectura diseño de software.
class entregas extends Model implements interfaceFactory
{ 
      use HasFactory;
#Tablas de mi base de datos.
    protected $table ='insumos';
#Creación de valores guia 5 diseño cliente servidor.
    protected $fillable =[
        'nombre',
        'factura_id',
        'fecha',
        'cliente'
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

   # public function GetId($id){return this->$id;}
    }

