<?php

namespace App\Models;

use App\FactoryMethod\interfaceFactory;
use Illuminate\Database\Eloquent\Model;

class insumos extends Model implements interfaceFactory
{
    use HasFactory;
#Tablas de mi base de datos.
    protected $table ='insumos';

    protected $fillable =[
        'id',
        'nombre',
        'unidad',
        'cantidad',
        'categoria',
        'proveedor'

    ];
    public function createInventory($nombre){
        //
    }
}
