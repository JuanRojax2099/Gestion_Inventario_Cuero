<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
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
            <h2>Detalles del Producto</h2>

            <div id="alert-error" class="alert alert-danger"></div>
            <div id="alert-success" class="alert alert-success"></div>

            <form id="producto-form">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" id="id" name="id" readonly>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="precio_unitario">Precio Unitario:</label>
                    <input type="number" step="0.01" id="precio_unitario" name="precio_unitario" required>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-save" onclick="saveChanges()">Guardar Cambios</button>
                    <a href="/admin/inventory" class="btn-back">Volver</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const productoId = {{ $producto->id }};

        function loadProductoDetails() {
            fetch('/api/producto/' + productoId, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Error al cargar los datos del producto.');
                }
                return response.json();
            })
            .then(function(data) {
                document.getElementById('id').value = data.id;
                document.getElementById('nombre').value = data.nombre;
                document.getElementById('descripcion').value = data.descripcion || '';
                document.getElementById('precio_unitario').value = data.precio_unitario || '';
            })
            .catch(function(error) {
                showAlert('error', error.message);
            });
        }

        function saveChanges() {
            const formData = {
                nombre: document.getElementById('nombre').value,
                descripcion: document.getElementById('descripcion').value,
                precio_unitario: document.getElementById('precio_unitario').value
            };

            fetch('/api/producto/' + productoId, {
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
            .then(function() {
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
            loadProductoDetails();
        });
    </script>
</body>
</html>
