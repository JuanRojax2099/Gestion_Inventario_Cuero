<?php
#Clase Control de factoryMethod Diseño de patron Guia 5
namespace App;
#Primer commit de wilder.
class factoryModel implements factoryInterface//fACTORY METHOD APLICADO POR CADA CONTROLADOR 
//implementar factory en entregas, producto(sus tablas relacionadas) e insumos.
//Factory Method o Simple Factory tiene mayor escabilidad.
{
    /**
     * Create a new class instance.
     */
    public static function create($ModelType){
            match($ModelType){
            'insumos' => new insumos(),
            'entregas' => new entregas(),
            'facturas' => new facturas(),
            'facturas_detalles' => new facturas_detalles(),
            'producto_insumo' => new producto_insumo(),
            'producto' => new producto(),
            'proveedores' => new proveedores(),
           default => new exception("Tipo de modelo no válido")
            };
    }
    public function __construct()
    {
    
    }
}//como se utilizara en el controlador :La ruta api llama la función del usercontroller->factory->retorna la instancia-> se llama la función de crear instancia con el json guardado-> se envia a la base de datos. 
