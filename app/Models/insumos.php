<?php
#Todos los modelos son DE Arquitectura de diseño de datos.
namespace App\Models;
use App\FactoryMethod\interfaceFactory;
use Illuminate\Database\Eloquent\Model;

class insumos extends Model
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
    /**
     * Constructor privado basado en los atributos fillable. GUIA 6 ARQUITECTURA Y DISEÑO
     */
    private function constructor(): void
    {
        foreach ($this->fillable as $attribute) {
            $this->attributes[$attribute] = null;
        }
    }

    public function createInventory($nombre){
        //
    }
      #public function GetId($id){return this->$id;}

}
