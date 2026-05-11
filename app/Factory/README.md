# Documentación del Patrón SimpleFactory

## Descripción General

Se ha implementado el patrón de diseño **SimpleFactory** para centralizar la creación de instancias de los modelos:
- `insumos`
- `producto`
- `producto_insumo`

Este patrón proporciona un método único y consistente para crear objetos, encapsulando la lógica de creación.

---

## Estructura de la Implementación

### 1. **Interfaz: `App\factoryInterface`**
   - Ubicación: `app/interface/factoryInterface.php`
   - Define la estructura del factory y el enum `modeltype`
   - Método: `create($ModelType): modeltype`

### 2. **Enum: `modeltype`**
   - Define los tipos de modelos disponibles:
     - `INSUMO` → 'insumos'
     - `PRDOUCTO` → 'producto'
     - `PRDOCUTO_INSUMO` → 'producto_insumo'
     - `ENTREGA` → 'entrega'
     - `FACTURA` → 'factura'
     - `FACTURA_DETALLE` → 'factura_detalle'

### 3. **Clase: `App\Factory\SimpleFactory`**
   - Ubicación: `app/Factory/SimpleFactory.php`
   - Implementa la interfaz `factoryInterface`
   - Proporciona múltiples métodos de creación

---

## Métodos Disponibles

### 1. **create($ModelType): object**
```php
$factory = new SimpleFactory();
$insumo = $factory->create(modeltype::INSUMO);
$producto = $factory->create(modeltype::PRDOUCTO);
$relacion = $factory->create(modeltype::PRDOCUTO_INSUMO);
```
Crea una instancia vacía del modelo especificado usando el enum.

---

### 2. **createWithAttributes($ModelType, array $attributes): object**
```php
$factory = new SimpleFactory();
$insumo = $factory->createWithAttributes(
    modeltype::INSUMO,
    [
        'nombre' => 'Cuero Premium',
        'unidad' => 'kg',
        'cantidad' => 100,
        'categoria' => 'Materias Primas',
        'proveedor' => 'Proveedor A'
    ]
);
```
Crea una instancia del modelo con atributos iniciales.

---

### 3. **createByName(string $typeName, array $attributes): object**
```php
$factory = new SimpleFactory();
$insumo = $factory->createByName('insumos', [
    'nombre' => 'Cuero Estándar',
    'unidad' => 'metros',
    'cantidad' => 50,
    'categoria' => 'Materias Primas',
    'proveedor' => 'Proveedor B'
]);
```
Crea una instancia usando el nombre del modelo como string en lugar del enum.
Tipos válidos: `'insumos'`, `'producto'`, `'producto_insumo'`

---

### 4. **getModelTypeByName(string $typeName): modeltype**
```php
$factory = new SimpleFactory();
$tipo = $factory->getModelTypeByName('insumos');
```
Convierte el nombre del modelo (string) al enum correspondiente.

---

## Casos de Uso

### Ejemplo 1: Crear un insumo en un controlador
```php
namespace App\Http\Controllers;

use App\Factory\SimpleFactory;
use App\modeltype;

class InsumoController extends Controller
{
    public function store(Request $request)
    {
        $factory = new SimpleFactory();
        
        $insumo = $factory->createWithAttributes(
            modeltype::INSUMO,
            $request->validated()
        );
        
        $insumo->save();
        
        return response()->json(['mensaje' => 'Insumo creado']);
    }
}
```

### Ejemplo 2: Crear un producto en un servicio
```php
namespace App\Services;

use App\Factory\SimpleFactory;

class ProductoService
{
    private SimpleFactory $factory;
    
    public function __construct()
    {
        $this->factory = new SimpleFactory();
    }
    
    public function registrarProducto(array $datos)
    {
        $producto = $this->factory->createByName('producto', $datos);
        $producto->save();
        
        return $producto;
    }
}
```

### Ejemplo 3: Crear relación producto-insumo
```php
$factory = new SimpleFactory();

$relacion = $factory->createWithAttributes(
    modeltype::PRDOCUTO_INSUMO,
    [
        'producto_id' => 1,
        'insumo_id' => 5
    ]
);

$relacion->save();
```

---

## Ventajas del Patrón SimpleFactory

✅ **Centralización**: Toda la lógica de creación está en un único lugar
✅ **Mantenimiento**: Cambios en la creación afectan un solo archivo
✅ **Consistencia**: Todos los modelos se crean de la misma manera
✅ **Escalabilidad**: Fácil agregar nuevos tipos de modelos
✅ **Flexibilidad**: Múltiples métodos de creación (enum, nombre, atributos)
✅ **Reutilizable**: Se puede inyectar como dependencia

---

## Manejo de Errores

El factory lanza excepciones `\InvalidArgumentException` cuando:
- Se intenta crear un modelo con un tipo inválido
- Se usa un nombre de modelo que no existe

```php
try {
    $modelo = $factory->createByName('tipo_invalido');
} catch (\InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}
```

---

## Inyección de Dependencias (Recomendado)

Para una mejor práctica, inyecta el factory en tus controladores o servicios:

```php
namespace App\Http\Controllers;

use App\Factory\SimpleFactory;

class ProductController extends Controller
{
    public function __construct(private SimpleFactory $factory)
    {
    }
    
    public function crear()
    {
        $producto = $this->factory->createByName('producto', [
            'nombre' => 'Mi Producto',
            'precio' => 99.99
        ]);
        
        return response()->json($producto);
    }
}
```

---

## Estructura de Archivos

```
app/
├── Factory/
│   └── SimpleFactory.php          ← Implementación del factory
├── interface/
│   └── factoryInterface.php       ← Interfaz y enum
├── Models/
│   ├── insumos.php
│   ├── producto.php
│   └── producto_insumo.php
└── Http/
    └── Controllers/
        └── FactoryExampleController.php  ← Ejemplos de uso
```

---

## Notas Importantes

- El factory está disponible en el namespace `App\Factory`
- Se requiere importar `SimpleFactory` y `modeltype` para usarlo
- Los atributos se asignan directamente al objeto del modelo
- El factory no ejecuta `save()` automáticamente; tú controlas cuándo persisten los datos

---

**Versión**: 1.0  
**Patrón**: SimpleFactory (Creational Pattern)  
**Última actualización**: 2026-05-08
