<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Historial Comercial</title>
<link rel="stylesheet" href="{{ asset('css/bootstrap5.8.3/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/design/landing.css') }}">
<style>
    body { background: #0d1117; color: #f8f9fa; }
    .page-card { background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); }
    .table-card { background: rgba(255,255,255,.02); }
    .btn-success, .btn-success:hover { background-color: #198754; border-color: #198754; }
    .btn-outline-success { color: #198754; border-color: #198754; }
    .btn-outline-success.active { background-color: #198754; color: #fff; }
    .table thead th { background-color: #198754; color: #fff; }
    .status-filter { max-width: 320px; }
    .text-muted { color: #cbd5e1 !important; }
</style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h2 class="mb-2">Historial Comercial</h2>
            <p class="text-muted">Visualiza el historial de compras de clientes y proveedores.</p>
        </div>
        <a href="{{ route('landing') }}" class="btn btn-success">Volver al panel</a>
    </div>

    <div class="card page-card shadow mb-4 p-4">
        <div class="d-flex gap-2 flex-wrap mb-4">
            <button id="showCliente" class="btn btn-outline-success active" type="button">Historial de Clientes</button>
            <button id="showProveedor" class="btn btn-outline-success" type="button">Historial de Proveedores</button>
        </div>

        <div id="clienteSection">
            <div class="card table-card mb-4 shadow-sm">
                <div class="card-header bg-success text-white">Historial de Compras de Clientes</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>NIT</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($historialClientes as $item)
                                    <tr data-status="{{ strtolower($item->estado ?? 'pendiente') }}">
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->cliente ?? $item->empresa ?? 'Sin cliente' }}</td>
                                        <td>{{ $item->nit ?? $item->documento ?? '-' }}</td>
                                        <td>{{ $item->producto ?? $item->detalle ?? 'N/A' }}</td>
                                        <td>{{ $item->cantidad ?? $item->unidades ?? '-' }}</td>
                                        <td>{{ $item->fecha ?? $item->created_at ?? '-' }}</td>
                                        <td>{{ $item->total ?? $item->valor ?? '-' }}</td>
                                        <td>{{ $item->estado ?? 'Pendiente' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No hay registros de compras de clientes.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="proveedorSection" style="display:none;">
            <div class="card table-card mb-4 shadow-sm">
                <div class="card-header bg-success text-white">Historial de Compras a Proveedores</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Proveedor</th>
                                    <th>Insumo</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>
                                    <th>Costo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($historialProveedores as $item)
                                    <tr data-status="{{ strtolower($item->estado ?? 'pendiente') }}">
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->proveedor ?? $item->empresa ?? 'Sin proveedor' }}</td>
                                        <td>{{ $item->insumo ?? $item->detalle ?? 'N/A' }}</td>
                                        <td>{{ $item->cantidad ?? $item->unidades ?? '-' }}</td>
                                        <td>{{ $item->fecha ?? $item->created_at ?? '-' }}</td>
                                        <td>{{ $item->costo ?? $item->valor ?? '-' }}</td>
                                        <td>{{ $item->estado ?? 'Pendiente' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No hay registros de compras a proveedores.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end align-items-center gap-3">
            <label for="statusFilter" class="mb-0 text-white">Estado:</label>
            <select id="statusFilter" class="form-select status-filter">
                <option value="all">Todos</option>
                <option value="entregado">Entregado</option>
                <option value="en proceso">En proceso</option>
                <option value="pendiente">Pendiente</option>
            </select>
        </div>
    </div>
</div>

<script>
    const showCliente = document.getElementById('showCliente');
    const showProveedor = document.getElementById('showProveedor');
    const clienteSection = document.getElementById('clienteSection');
    const proveedorSection = document.getElementById('proveedorSection');
    const statusFilter = document.getElementById('statusFilter');

    function toggleSection(section) {
        if (section === 'cliente') {
            clienteSection.style.display = 'block';
            proveedorSection.style.display = 'none';
            showCliente.classList.add('active');
            showProveedor.classList.remove('active');
        } else {
            clienteSection.style.display = 'none';
            proveedorSection.style.display = 'block';
            showCliente.classList.remove('active');
            showProveedor.classList.add('active');
        }
        filterStatus();
    }

    function filterStatus() {
        const filter = statusFilter.value;
        const visibleSection = clienteSection.style.display !== 'none' ? clienteSection : proveedorSection;
        visibleSection.querySelectorAll('tbody tr').forEach(row => {
            const status = row.dataset.status?.trim().toLowerCase() || 'pendiente';
            row.style.display = filter === 'all' || status === filter ? '' : 'none';
        });
    }

    showCliente.addEventListener('click', () => toggleSection('cliente'));
    showProveedor.addEventListener('click', () => toggleSection('proveedor'));
    statusFilter.addEventListener('change', filterStatus);
</script>

</body>
</html>

</body>
</html>