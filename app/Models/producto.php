<?php

namespace App\Models;
use App\FactoryMethod\interfaceFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model implements interfaceFactorys
{
        use HasFactory;
#Tablas de mi base de datos.
    protected $table ='insumos';

    protected $fillable =[
        'id',
        'nombre',
        'descripción',
        'precio'

    ];
        public function createInventory($nombre){
           //Crear Coso que meta los datos
        }

}
