<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Insumos</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #111;
            color: #fff;
        }

        .page-wrapper {
            min-height: 100vh;
            padding: 30px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            background: #111;
        }

        .inventory-card {
            width: min(1100px, 100%);
            background: #248114;
            padding: 18px;
            box-sizing: border-box;
            border-radius: 6px;
        }

        .inventory-panel {
            background: #fff;
            border-radius: 6px;
            overflow: hidden;
        }

        .inventory-header {
            display: grid;
            grid-template-columns: 60px 1.5fr 1fr 1fr 1fr 1.2fr;
            gap: 0;
            background: #248114;
            color: #fff;
            text-transform: uppercase;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 16px 20px;
        }

        .inventory-header div {
            padding: 0 6px;
        }

        .inventory-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        .inventory-table tbody tr:nth-child(even) {
            background: #f6f6f6;
        }

        .inventory-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #ececec;
            color: #222;
            font-size: 0.95rem;
        }

        .inventory-table tbody tr:last-child td {
            border-bottom: none;
        }

        .no-data {
            text-align: center;
            padding: 36px 20px;
            color: #666;
        }

        .footer-actions {
            margin-top: 20px;
        }

        .btn-back {
            display: inline-block;
            background: #0f8b2f;
            color: #fff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-weight: 700;
            transition: background 0.2s ease;
        }

        .btn-back:hover {
            background: #0c7b28;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="inventory-card">
            <div class="inventory-panel">
                <div class="inventory-header">
                    <div>id</div>
                    <div>name</div>
                    <div>Unidad</div>
                    <div>Cantidad</div>
                    <div>Categoria</div>
                    <div>Proveedor</div>
                </div>
                <table class="inventory-table">
                    <tbody>
                        @forelse($consulta ?? [] as $insumo)
                            <tr>
                                <td>{{ $insumo->id }}</td>
                                <td>{{ $insumo->name }}</td>
                                <td>{{ $insumo->unidad }}</td>
                                <td>{{ $insumo->cantidad }}</td>
                                <td>{{ $insumo->categoria }}</td>
                                <td>{{ $insumo->proveedor }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="no-data">No hay insumos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="footer-actions">
                <a href="{{ url()->previous() }}" class="btn-back">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>
