<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Insumos</title>
    <link rel="stylesheet" href="{{ asset('css/design/inventory.css') }}">
</head>
<div class="  header d-flex justify-content-between align-items-center px-4">
<h2>Sistema de Gestión de Marroquinería-Inventario</h2>
<div class="col col-sm-3">
</div>
</div>
<body class="bg-dark">
    <div class="page-wrapper">
        <div class="inventory-card">
            <div class="footer-actions" style="margin-bottom: 20px;">
                <button class="btn-back" onclick="showSection('insumos-section')">Insumos</button>
                <button class="btn-back" onclick="showSection('productos-section')">Productos</button>
                <button class="btn-back" onclick="showSection('producto-insumo-section')">Producto-Insumo</button>
            </div>

            <div class="dashboard">
                <div class="dashboard-card">
                    <h3>Total de insumos</h3>
                    <strong>{{ $totalInsumos ?? 0 }}</strong>
                    <div>Cantidad total registrada</div>
                </div>
                <div class="dashboard-card">
                    <h3>Total de productos</h3>
                    <strong>{{ $totalProductos ?? 0 }}</strong>
                    <div>Productos disponibles</div>
                </div>
                <div class="dashboard-card">
                    <h3>Insumos en filtro</h3>
                    <strong>{{ $filteredInsumosCount ?? 0 }}</strong>
                    <div>Mostrados en la tabla</div>
                </div>
            </div>

            <div id="insumos-section" class="inventory-panel">
                <div class="filter-row">
                    <div>
                        <label for="categoria-filter">Filtrar por categoría:</label>
                        <select id="categoria-filter" name="categoria" onchange="applyCategoryFilter(this.value)">
                            <option value="">Todas las categorías</option>
                            @foreach($categorias ?? [] as $categoria)
                                <option value="{{ $categoria }}" {{ isset($selectedCategory) && $selectedCategory === $categoria ? 'selected' : '' }}>
                                    {{ $categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="button" onclick="resetCategoryFilter()">Limpiar filtro</button>
                    </div>
                </div>
                <div class="inventory-header cols-6">
                    <div>id</div>
                    <div>name</div>
                    <div>Unidad</div>
                    <div>Cantidad</div>
                    <div>Categoria</div>
                    <div>Proveedor</div>
                    <div>Acciones</div>
                </div>
                <table class="inventory-table">
                    <tbody>
                        @forelse($insumo ?? [] as $in)
                            <tr>
                                <td>{{ $in->id }}</td>
                                <td>{{ $in->name }}</td>
                                <td>{{ $in->unidad }}</td>
                                <td>{{ $in->cantidad }}</td>
                                <td>{{ $in->categoria }}</td>
                                <td>{{ $in->proveedor }}</td>
                                <td>
                                    <a class="btn-action btn-view" href="/admin/insumo/{{ $in->id }}">Ver</a>
                                    <a class="btn-action btn-delete" href="javascript:void(0)" onclick="deleteInsumo({{ $in->id }})">Eliminar</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="no-data">No hay insumos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="productos-section" class="inventory-panel" style="display: none;">
                <div class="inventory-header cols-5">
                    <div>id</div>
                    <div>Nombre</div>
                    <div>Descripción</div>
                    <div>Precio Unitario</div>
                    <div>Acciones</div>
                </div>
                <table class="inventory-table">
                    <tbody>
                        @forelse($producto ?? [] as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->nombre }}</td>
                                <td>{{ $p->descripción }}</td>
                                <td>{{ $p->precio_unitario }}</td>
                                <td>
                                    <a class="btn-action btn-view" href="/admin/producto/{{ $p->id }}">Ver</a>
                                    <a class="btn-action btn-delete" href="javascript:void(0)" onclick="deleteProducto({{ $p->id }})">Eliminar</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="no-data">No hay productos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="producto-insumo-section" class="inventory-panel" style="display: none;">
                <div class="filter-row">
                    <div>
                        <label for="producto-filter">Filtrar por producto:</label>
                        <select id="producto-filter" name="producto_id" onchange="applyProductFilter(this.value)">
                            <option value="">Todos los productos</option>
                            @foreach($producto ?? [] as $prod)
                                <option value="{{ $prod->id }}" {{ isset($selectedProductId) && $selectedProductId == $prod->id ? 'selected' : '' }}>
                                    {{ $prod->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="button" onclick="resetProductFilter()">Limpiar filtro</button>
                    </div>
                </div>
                <div class="inventory-header cols-4">
                    <div>Producto ID</div>
                    <div>Producto</div>
                    <div>Insumo ID</div>
                    <div>Insumo</div>
                </div>
                <table class="inventory-table">
                    <tbody>
                        @forelse($productoinsumo ?? [] as $relacion)
                            <tr>
                                <td>{{ $relacion->producto_id }}</td>
                                <td>{{ $productosById[$relacion->producto_id] ?? 'N/D' }}</td>
                                <td>{{ $relacion->insumo_id }}</td>
                                <td>{{ $insumosById[$relacion->insumo_id] ?? 'N/D' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="no-data">No hay relaciones producto-insumo registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="footer-actions">
                <a href="{{ route('landing') }}" class="btn-back">Volver</a>
            </div>
        </div>
    </div>
    <script>
        function showSection(section) {
            var sections = ['insumos-section', 'productos-section', 'producto-insumo-section'];
            sections.forEach(function(id) {
                document.getElementById(id).style.display = id === section ? 'block' : 'none';
            });
        }

        function deleteInsumo(id) {
            if (!confirm('¿Deseas eliminar este insumo?')) {
                return;
            }

            fetch('/api/insumo/' + id, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    return response.text().then(function(text) {
                        var message = 'Error al eliminar el insumo.';
                        try {
                            var data = JSON.parse(text);
                            message = data.message || message;
                        } catch (e) {
                            if (text) {
                                message = text;
                            }
                        }
                        throw new Error(message);
                    });
                }

                if (response.status === 204 || response.headers.get('content-length') === '0') {
                    return;
                }

                return response.text().then(function(text) {
                    if (!text) {
                        return;
                    }
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        return;
                    }
                });
            })
            .then(function() {
                window.location.reload();
            })
            .catch(function(error) {
                alert(error.message);
            });
        }

        function applyCategoryFilter(category) {
            var url = new URL(window.location.href);
            if (category) {
                url.searchParams.set('categoria', category);
            } else {
                url.searchParams.delete('categoria');
            }
            window.location.href = url.toString();
        }

        function resetCategoryFilter() {
            applyCategoryFilter('');
        }

        const allProductoInsumoData = @json($allProductoInsumo);
        const productosByIdData = @json($productosById);
        const insumosByIdData = @json($insumosById);
        const initialProductId = '{{ $selectedProductId ?? '' }}';

        function renderProductoInsumoRows(rows) {
            var tbody = document.querySelector('#producto-insumo-section .inventory-table tbody');
            if (!tbody) {
                return;
            }

            if (rows.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="no-data">No hay relaciones producto-insumo registradas.</td></tr>';
                return;
            }

            tbody.innerHTML = rows.map(function(relacion) {
                var productoNombre = productosByIdData[relacion.producto_id] || 'N/D';
                var insumoNombre = insumosByIdData[relacion.insumo_id] || 'N/D';
                return '<tr>' +
                    '<td>' + relacion.producto_id + '</td>' +
                    '<td>' + productoNombre + '</td>' +
                    '<td>' + relacion.insumo_id + '</td>' +
                    '<td>' + insumoNombre + '</td>' +
                '</tr>';
            }).join('');
        }

        function applyProductFilter(productId) {
            if (productId) {
                var filtered = allProductoInsumoData.filter(function(item) {
                    return String(item.producto_id) === String(productId);
                });
                renderProductoInsumoRows(filtered);
            } else {
                renderProductoInsumoRows(allProductoInsumoData);
            }
        }

        function resetProductFilter() {
            var select = document.getElementById('producto-filter');
            if (select) {
                select.value = '';
            }
            renderProductoInsumoRows(allProductoInsumoData);
        }

        function deleteProducto(id) {
            if (!confirm('¿Deseas eliminar este producto?')) {
                return;
            }

            fetch('/api/producto/' + id, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    return response.text().then(function(text) {
                        var message = 'Error al eliminar el producto.';
                        try {
                            var data = JSON.parse(text);
                            message = data.message || message;
                        } catch (e) {
                            if (text) {
                                message = text;
                            }
                        }
                        throw new Error(message);
                    });
                }
                return response.json();
            })
            .then(function() {
                window.location.reload();
            })
            .catch(function(error) {
                alert(error.message);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (initialProductId) {
                applyProductFilter(initialProductId);
            } else {
                renderProductoInsumoRows(allProductoInsumoData);
            }
            showSection('insumos-section');
        });
    </script>
</body>
</html>
