<?php

namespace App\Models;
use App\FactoryMethod\interfaceFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model implements interfaceFactorys
{
        use HasFactory;
#Tablas de mi base de datos.
    protected $table ='producto';

    protected $fillable =[
        'id',
        'nombre',
        'descripción',
        'precio'

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

        public function createInventory($nombre){
           //Crear Coso que meta los datos
        }
          #public function GetId($id){return this->$id;}

}
