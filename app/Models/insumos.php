<?php
#Todos los modelos son DE Arquitectura de diseño de datos.
namespace App\Models;

use App\FactoryMethod\interfaceFactory;
use Illuminate\Database\Eloquent\Model;

class insumos extends Model implements interfaceFactory
{
    use HasFactory;
#Tablas de mi base de datos.
    protected $table ='insumos';
#Creación de valores guia 5 diseño cliente servidor.
    protected $fillable =[
        'nombre',
        'unidad',
        'cantidad',
        'categoria',
        'proveedor'

    ];
    public function createInventory($nombre){
        //
    }
      #public function GetId($id){return this->$id;}

}
