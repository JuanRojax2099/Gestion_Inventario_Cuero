<?php
#Clase Control de factoryMethod Diseño de patron Guia 5
namespace App;

class factoryModel
{
    /**
     * Create a new class instance.
     */
    public static function create($ModelType){
            match($ModelType){
            'insumos' => new insumos(),
            'entregas' => new entregas(),
            'facturas' => new facturas(),
            'facturas_deta  lles' => new facturas_detalles(),
            'producto_insumo' => new producto_insumo(),
            'producto' => new producto(),
            'proveedores' => new proveedores(),
           default => new exception("Tipo de modelo no válido")
            };
    }
    public function __construct()
    {
    
    }
}
