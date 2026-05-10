<?php
#Todos los modelos son DE Arquitectura de diseño de datos.
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function productos()
    {
        return $this->belongsToMany(producto::class, 'producto_insumo');
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
     * Factory Method: Crea una nueva instancia de insumo
     * 
     * @param array $attributes Atributos iniciales del insumo
     * @return self Nueva instancia de insumo
     */
    public static function factory(array $attributes = []): self
    {
        $insumo = new self();
        foreach ($attributes as $key => $value) {
            $insumo->$key = $value;
        }
        return $insumo;
    }

    /**
     * Factory Method: Crea y guarda una nueva instancia de insumo
     * 
     * @param array $attributes Atributos del insumo a crear
     * @return self Insumo creado y guardado en la BD
     */
    public static function createInsumo(array $attributes): self
    {
        $insumo = self::factory($attributes);
        $insumo->save();
        return $insumo;
    }

    public function createInventory($nombre){
        //
    }
      #public function GetId($id){return this->$id;}

}
