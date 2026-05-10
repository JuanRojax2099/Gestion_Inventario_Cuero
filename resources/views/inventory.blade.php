<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap5.8.3/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/design/landing.css') }}">
    <style>
        .table-container { display: none; }
        .active { display: block; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Inventario</h2>

        <!-- Dashboard de selección -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Seleccionar Tabla</h5>
                    </div>
                    <div class="card-body text-center">
                        <button class="btn btn-primary me-2" onclick="showTable('productos')">Productos</button>
                        <button class="btn btn-secondary me-2" onclick="showTable('insumos')">Insumos</button>
                        <button class="btn btn-success" onclick="showTable('producto_insumo')">Producto-Insumo</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla Productos -->
        <div id="productos" class="table-container active">
            <div class="card shadow">
                <div class="card-header tabla-header">
                    Productos
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->descripción ?? 'N/A' }}</td>
                                <td>{{ $producto->precio ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tabla Insumos -->
        <div id="insumos" class="table-container">
            <div class="card shadow">
                <div class="card-header tabla-header">
                    Insumos
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Unidad</th>
                                <th>Cantidad</th>
                                <th>Categoría</th>
                                <th>Proveedor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($insumos as $insumo)
                            <tr>
                                <td>{{ $insumo->id }}</td>
                                <td>{{ $insumo->nombre }}</td>
                                <td>{{ $insumo->unidad }}</td>
                                <td>{{ $insumo->cantidad }}</td>
                                <td>{{ $insumo->categoria ?? 'N/A' }}</td>
                                <td>{{ $insumo->proveedor }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tabla Producto-Insumo -->
        <div id="producto_insumo" class="table-container">
            <div class="card shadow">
                <div class="card-header tabla-header">
                    Relaciones Producto-Insumo
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Insumo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($producto_insumos as $relacion)
                            <tr>
                                <td>{{ $relacion->id }}</td>
                                <td>{{ $relacion->producto->nombre ?? 'N/A' }}</td>
                                <td>{{ $relacion->insumo->nombre ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTable(tableId) {
            // Ocultar todas las tablas
            const tables = document.querySelectorAll('.table-container');
            tables.forEach(table => table.classList.remove('active'));

            // Mostrar la tabla seleccionada
            document.getElementById(tableId).classList.add('active');
        }
    </script>
</body>
</html>