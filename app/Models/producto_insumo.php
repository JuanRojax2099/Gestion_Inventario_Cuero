<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class producto_insumo extends Model
{
      use HasFactory;
#Tablas de mi base de datos.
    protected $table ='producto_insumo';
#Creación de valores guia 5 diseño cliente servidor.
    protected $fillable =[
        'producto_id',
        'insumo_id',
    ];

    public function producto()
    {
        return $this->belongsTo(producto::class, 'producto_id');
    }

    public function insumo()
    {
        return $this->belongsTo(insumos::class, 'insumo_id');
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
     * Factory Method: Crea una nueva instancia de relación producto-insumo
     * 
     * @param array $attributes Atributos iniciales de la relación
     * @return self Nueva instancia de relación
     */
    public static function factory(array $attributes = []): self
    {
        $relacion = new self();
        foreach ($attributes as $key => $value) {
            $relacion->$key = $value;
        }
        return $relacion;
    }

    /**
     * Factory Method: Crea y guarda una nueva relación producto-insumo
     * 
     * @param array $attributes Atributos de la relación a crear
     * @return self Relación creada y guardada en la BD
     */
    public static function createRelacion(array $attributes): self
    {
        $relacion = self::factory($attributes);
        $relacion->save();
        return $relacion;
    }

    #public function GetId($id){return this->$id;}

}
