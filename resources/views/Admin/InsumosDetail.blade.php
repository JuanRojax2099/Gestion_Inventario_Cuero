<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Insumo</title>
    <link href="{{ asset('css/design/inventory.css') }}" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="detail-page">
        <div class="detail-card">
            <h2>Detalles del Insumo</h2>

            <div id="alert-error" class="alert alert-danger"></div>
            <div id="alert-success" class="alert alert-success"></div>

            <form id="insumo-form">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" id="id" name="id" readonly>
                </div>

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="unidad">Unidad:</label>
                    <input type="text" id="unidad" name="unidad" required>
                </div>

                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" required>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <input type="text" id="categoria" name="categoria" required>
                </div>

                <div class="form-group">
                    <label for="proveedor">Proveedor:</label>
                    <input type="text" id="proveedor" name="proveedor" required>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-save" onclick="saveChanges()">Guardar Cambios</button>
                    <a href="/admin/inventory" class="btn-back">Volver</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const insumoId = {{ $insumo->id }};

        function loadInsumoDetails() {
            fetch('/api/insumo/' + insumoId, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Error al cargar los datos del insumo.');
                }
                return response.json();
            })
            .then(function(data) {
                document.getElementById('id').value = data.id;
                document.getElementById('name').value = data.name;
                document.getElementById('unidad').value = data.unidad;
                document.getElementById('cantidad').value = data.cantidad;
                document.getElementById('categoria').value = data.categoria;
                document.getElementById('proveedor').value = data.proveedor;
            })
            .catch(function(error) {
                showAlert('error', error.message);
            });
        }

        function saveChanges() {
            const formData = {
                name: document.getElementById('name').value,
                unidad: document.getElementById('unidad').value,
                cantidad: document.getElementById('cantidad').value,
                categoria: document.getElementById('categoria').value,
                proveedor: document.getElementById('proveedor').value
            };

            fetch('/api/insumo/' + insumoId, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(function(response) {
                if (!response.ok) {
                    return response.json().then(function(data) {
                        throw new Error(data.message || 'Error al guardar los cambios.');
                    });
                }
                return response.json();
            })
            .then(function(data) {
                showAlert('success', 'Cambios guardados correctamente.');
                setTimeout(function() {
                    window.location.href = '/admin/inventory';
                }, 1500);
            })
            .catch(function(error) {
                showAlert('error', error.message);
            });
        }

        function showAlert(type, message) {
            const errorAlert = document.getElementById('alert-error');
            const successAlert = document.getElementById('alert-success');

            if (type === 'error') {
                errorAlert.textContent = message;
                errorAlert.style.display = 'block';
                successAlert.style.display = 'none';
            } else if (type === 'success') {
                successAlert.textContent = message;
                successAlert.style.display = 'block';
                errorAlert.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadInsumoDetails();
        });
    </script>
</body>
</html>
