<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Details</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap5.8.3/css/bootstrap.min.css') }}">
</head>
<body class="bg-light text-dark">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Factura #{{ $factura->id ?? 'N/A' }}</h2>
                <p class="mb-0"><strong>Proveedor:</strong> {{ $factura->proveedor ?? 'N/A' }}</p>
                <p class="mb-0"><strong>Fecha:</strong> {{ $factura->fecha ?? 'N/A' }}</p>
            </div>
            <a href="{{ route('calendario') }}" class="btn btn-secondary">Volver al calendario</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Información de la factura</h5>
                <p class="card-text"><strong>Detalles:</strong> {{ $factura->detalles ?? 'Sin detalles' }}</p>
            </div>
        </div>

        <div class="mb-3">
            <button id="btn-toggle-productos" class="btn btn-primary" onclick="toggleProductos()">Mostrar productos</button>
        </div>

        <div id="productos-table" class="card" style="display: none;">
            <div class="card-body">
                <h5 class="card-title">Productos asociados</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID producto</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Unidad de medida</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($detalleItems as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['nombre'] }}</td>
                                    <td>{{ $item['cantidad'] }}</td>
                                    <td>{{ $item['unidad'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No se encontraron productos para esta factura.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleProductos() {
            const container = document.getElementById('productos-table');
            const button = document.getElementById('btn-toggle-productos');
            if (container.style.display === 'none' || container.style.display === '') {
                container.style.display = 'block';
                button.textContent = 'Ocultar productos';
            } else {
                container.style.display = 'none';
                button.textContent = 'Mostrar productos';
            }
        }
    </script>
</body>
</html>
