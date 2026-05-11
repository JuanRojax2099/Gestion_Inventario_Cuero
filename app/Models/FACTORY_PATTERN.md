# Patrón Factory Integrado en los Modelos

## Descripción

El patrón SimpleFactory ha sido **integrado directamente en cada modelo** como métodos estáticos. Esto elimina dependencias externas y proporciona una forma limpia y Laravel-nativa de crear instancias.

---

## Métodos Disponibles

Cada modelo (`insumos`, `producto`, `producto_insumo`) implementa dos métodos de factory:

### 1. **factory(array $attributes = []): self**
Crea una instancia del modelo **sin guardar** en la base de datos.

```php
// Crear insumo vacío
$insumo = insumos::factory();

// Crear con atributos iniciales
$insumo = insumos::factory([
    'nombre' => 'Cuero Premium',
    'unidad' => 'kg',
    'cantidad' => 100,
    'categoria' => 'Materias Primas',
    'proveedor' => 'Proveedor A'
]);
```

### 2. **create[Model](array $attributes): self**
Crea una instancia del modelo **y la guarda automáticamente** en la base de datos.

- **insumos**: `insumos::createInsumo(array $attributes)`
- **producto**: `producto::createProducto(array $attributes)`
- **producto_insumo**: `producto_insumo::createRelacion(array $attributes)`

```php
// Crear y guardar automáticamente
$insumo = insumos::createInsumo([
    'nombre' => 'Cuero Nobuk',
    'unidad' => 'kg',
    'cantidad' => 75,
    'categoria' => 'Materias Primas',
    'proveedor' => 'Proveedor B'
]);
```

---

## Ejemplos por Modelo

### Modelo: `insumos`

```php
use App\Models\insumos;

// Crear sin guardar
$insumo = insumos::factory([
    'nombre' => 'Cuero Estándar',
    'unidad' => 'metros',
    'cantidad' => 50,
    'categoria' => 'Materias Primas',
    'proveedor' => 'Proveedor A'
]);

// Crear y guardar
$insumo = insumos::createInsumo([
    'nombre' => 'Cuero Premium',
    'unidad' => 'kg',
    'cantidad' => 100,
    'categoria' => 'Materias Primas',
    'proveedor' => 'Proveedor B'
]);
```

### Modelo: `producto`

```php
use App\Models\producto;

// Crear sin guardar
$producto = producto::factory([
    'nombre' => 'Cinturón',
    'descripción' => 'Cinturón de cuero',
    'precio' => 45.99
]);

// Crear y guardar
$producto = producto::createProducto([
    'nombre' => 'Cartera',
    'descripción' => 'Cartera de cuero genuino',
    'precio' => 89.99
]);
```

### Modelo: `producto_insumo`

```php
use App\Models\producto_insumo;

// Crear sin guardar
$relacion = producto_insumo::factory([
    'producto_id' => 1,
    'insumo_id' => 5
]);

// Crear y guardar
$relacion = producto_insumo::createRelacion([
    'producto_id' => 2,
    'insumo_id' => 3
]);
```

---

## Casos de Uso Reales

### Caso 1: En un Controlador

```php
namespace App\Http\Controllers;

use App\Models\producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function store(Request $request)
    {
        $producto = producto::createProducto($request->validated());
        
        return response()->json([
            'mensaje' => 'Producto creado',
            'producto' => $producto
        ], 201);
    }
}
```

### Caso 2: En un Servicio

```php
namespace App\Services;

use App\Models\insumos;
use App\Models\producto;
use App\Models\producto_insumo;

class InventarioService
{
    public function registrarProductoConInsumos($productoData, $insumosIds)
    {
        // Crear producto
        $producto = producto::createProducto($productoData);

        // Crear relaciones con insumos
        foreach ($insumosIds as $insumoId) {
            producto_insumo::createRelacion([
                'producto_id' => $producto->id,
                'insumo_id' => $insumoId
            ]);
        }

        return $producto;
    }
}
```

### Caso 3: En un Seeder

```php
namespace Database\Seeders;

use App\Models\insumos;
use App\Models\producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        // Crear insumos
        $cuero = insumos::createInsumo([
            'nombre' => 'Cuero Natural',
            'unidad' => 'kg',
            'cantidad' => 1000,
            'categoria' => 'Materias Primas',
            'proveedor' => 'Proveedor Premium'
        ]);

        // Crear producto
        $cinturon = producto::createProducto([
            'nombre' => 'Cinturón de Cuero',
            'descripción' => 'Cinturón de alta calidad',
            'precio' => 75.00
        ]);
    }
}
```

---

## Flujo de Creación

```
factory()                 ┌─────────────────────────┐
  ▼                       │  Nueva Instancia       │
  Crea instancia   ───▶   │  Sin guardar en BD     │
  en memoria              └─────────────────────────┘

createInsumo()            ┌─────────────────────────┐
  ▼                       │  Nueva Instancia       │
  Crea instancia   ───▶   │  Guardada en BD        │
  y guarda                └─────────────────────────┘
```

---

## Características

✅ **Integrado**: Sin dependencias externas de interfaces  
✅ **Simple**: Métodos estáticos directo en el modelo  
✅ **Flexible**: Tanto crear como crear+guardar  
✅ **Limpio**: Código más legible y mantenible  
✅ **Type-safe**: Retorna instancias tipadas  
✅ **Escalable**: Fácil agregar nuevos métodos  

---

## Migración desde SimpleFactory

Si tienes código antiguo usando `SimpleFactory`:

```php
// Antiguo
$factory = new SimpleFactory();
$insumo = $factory->createByName('insumos', $datos);

// Nuevo
$insumo = insumos::createInsumo($datos);
```

---

## Archivo Modificado: `app/Factory/SimpleFactory.php`

Si aún necesitas `SimpleFactory` para compatibilidad, ahora apunta a los métodos integrados:

```php
// Puedes seguir usando SimpleFactory como antes
// pero internamente usa los métodos del modelo
```

---

## Estructura de Carpetas

```
app/
├── Models/
│   ├── insumos.php              ← Con factory()
│   ├── producto.php             ← Con factory()
│   ├── producto_insumo.php      ← Con factory()
│   └── ...
├── Factory/
│   ├── SimpleFactory.php        ← Aún disponible (opcional)
│   └── README.md
└── Http/
    └── Controllers/
        └── FactoryPatternExamplesController.php
```

---

## Notas Importantes

- La carpeta `app/interface` ha sido **eliminada**
- Los métodos factory están **directamente en cada modelo**
- No hay dependencias de interfaces externas
- El patrón SimpleFactory sigue disponible en `app/Factory/` si lo necesitas

---

**Versión**: 2.0  
**Patrón**: SimpleFactory (Integrado)  
**Última actualización**: 2026-05-08
