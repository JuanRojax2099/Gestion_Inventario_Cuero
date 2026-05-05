<?php

namespace App;
enum modeltype: string
{
    case INSUMO ='insumos';
    case PRDOUCTO ='prducto';
    case PRDOCUTO_INSUMO ='producto_insumo';
    case ENTREGA ='entrega';
    case FACTURA ='factura';
    case FACTURA_DETALLE ='factura_detalle';

}
interface factoryInterface
{
//interface del factoryMethod

    public function create($ModelType):modeltype;
    
}
