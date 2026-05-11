<?php

namespace App\Factory;

use App\factoryInterface;
use App\modeltype;
use App\Models\insumos;
use App\Models\producto_insumo;
use App\Models\producto;

/**
 * SimpleFactory class
 * 
 * Implementa el patrón SimpleFactory para la creación de instancias
 * de los modelos: insumos, productos_insumos y productos.
 * 
 * @author Sistema de Gestión de Inventario
 * @version 1.0
 */
class SimpleFactory implements factoryInterface
{
    /**
     * Crea una instancia del modelo basado en el tipo especificado
     * 
     * @param modeltype $ModelType El tipo de modelo a crear (INSUMO, PRDOUCTO, PRDOCUTO_INSUMO)
     * @return object Una nueva instancia del modelo solicitado
     * @throws \InvalidArgumentException Si el tipo de modelo no es válido
     */
    public function create($ModelType): object
    {
        return match($ModelType) {
            modeltype::INSUMO => new insumos(),
            modeltype::PRDOUCTO => new producto(),
            modeltype::PRDOCUTO_INSUMO => new producto_insumo(),
            default => throw new \InvalidArgumentException(
                "Tipo de modelo no válido: {$ModelType->value}"
            )
        };
    }

    /**
     * Método alternativo: crea una instancia con atributos iniciales
     * 
     * @param modeltype $ModelType El tipo de modelo a crear
     * @param array $attributes Atributos iniciales del modelo
     * @return object Una nueva instancia del modelo con los atributos especificados
     */
    public function createWithAttributes($ModelType, array $attributes = []): object
    {
        $model = $this->create($ModelType);
        
        if (!empty($attributes)) {
            foreach ($attributes as $key => $value) {
                $model->$key = $value;
            }
        }
        
        return $model;
    }

    /**
     * Método para obtener el tipo de modelo según el nombre
     * 
     * @param string $typeName Nombre del tipo (e.g., 'insumos', 'producto', 'producto_insumo')
     * @return modeltype El tipo de modelo correspondiente
     */
    public function getModelTypeByName(string $typeName): modeltype
    {
        return match(strtolower($typeName)) {
            'insumos' => modeltype::INSUMO,
            'producto' => modeltype::PRDOUCTO,
            'producto_insumo' => modeltype::PRDOCUTO_INSUMO,
            default => throw new \InvalidArgumentException(
                "Nombre de modelo no válido: {$typeName}"
            )
        };
    }

    /**
     * Crea una instancia usando el nombre del modelo como string
     * 
     * @param string $typeName Nombre del tipo de modelo
     * @param array $attributes Atributos iniciales (opcional)
     * @return object Una nueva instancia del modelo
     */
    public function createByName(string $typeName, array $attributes = []): object
    {
        $modelType = $this->getModelTypeByName($typeName);
        return $this->createWithAttributes($modelType, $attributes);
    }
}
