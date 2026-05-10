<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class producto extends Model
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

    public function insumos()
    {
        return $this->belongsToMany(insumos::class, 'producto_insumo');
    }

    /**
     * Constructor privado basado en los atributos fillable. GUIA 6 ARQUITECTURA Y DISEÑO
     */
    private function constructor(): void
    {
        foreach ($this->fillable as $attribute) {
            $this->attributes[$attribute] = null;
        }
    }

    /**
     * Factory Method: Crea una nueva instancia de producto
     * 
     * @param array $attributes Atributos iniciales del producto
     * @return self Nueva instancia de producto
     */
    public static function factory(array $attributes = []): self
    {
        $producto = new self();
        foreach ($attributes as $key => $value) {
            $producto->$key = $value;
        }
        return $producto;
    }

    /**
     * Factory Method: Crea y guarda una nueva instancia de producto
     * 
     * @param array $attributes Atributos del producto a crear
     * @return self Producto creado y guardado en la BD
     */
    public static function createProducto(array $attributes): self
    {
        $producto = self::factory($attributes);
        $producto->save();
        return $producto;
    }

    public function createInventory($nombre){
       //Crear Coso que meta los datos
    }
      #public function GetId($id){return this->$id;}

}
