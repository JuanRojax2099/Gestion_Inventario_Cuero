<?php
#Todos los modelos son DE Arquitectura cliente servidor.GUIA 5
namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


#Creación de Setters y getters guia 6 Arquitectura diseño de software.
class entregas extends Model  
{ 
    use HasFactory, Notifiable, HasApiTokens;
#Tablas de mi base de datos.
    protected $table ='entregas';
#Creación de valores guia 5 diseño cliente servidor.
    protected $fillable =[
        'factura_id',
        'fecha',
        'cliente'
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

   # public function GetId($id){return this->$id;}
    }

