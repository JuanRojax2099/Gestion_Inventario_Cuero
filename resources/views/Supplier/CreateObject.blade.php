<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear nueva instancia</title>
<link rel="stylesheet" href="{{ asset('css/bootstrap5.8.3/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/design/landing.css') }}">
<style>
    .form-card { max-width: 760px; margin: 40px auto; }
    .option-card { cursor: pointer; }
    .option-card.active { border-color: #198754; box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, .25); }
</style>
</head>
<body class="bg-dark text-white">
<div class="container form-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Crear nueva instancia</h2>
            <p>Escoge un tipo y completa el formulario correspondiente.</p>
        </div>
        <a href="{{ route('landing') }}" class="btn btn-secondary">Volver al panel</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card option-card p-3 text-center" data-type="insumo">
                <h5>Insumo</h5>
                <p>Alta de nuevo insumo.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card option-card p-3 text-center" data-type="producto">
                <h5>Producto</h5>
                <p>Crear un producto con insumos.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card option-card p-3 text-center" data-type="historial_cliente">
                <h5>Historial cliente</h5>
                <p>Registrar o consultar historial.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card option-card p-3 text-center" data-type="historial_proveedor">
                <h5>Historial proveedor</h5>
                <p>Registrar o consultar historial.</p>
            </div>
        </div>
    </div>

    <div class="card bg-white text-dark p-4 shadow-sm">
        <div class="mb-3">
            <label for="objectType" class="form-label">Selecciona el tipo de instancia</label>
            <select id="objectType" class="form-select">
                <option value="">Seleccionar...</option>
                <option value="insumo">Insumo</option>
                <option value="producto">Producto</option>
                <option value="historial_cliente">Historial de cliente</option>
                <option value="historial_proveedor">Historial de proveedor</option>
            </select>
        </div>

        <div id="insumoForm" class="dynamic-form" style="display:none;">
            <h4>Crear Insumo</h4>
            <form action="{{ route('insumos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="insumoNombre" class="form-label">Nombre del Insumo</label>
                    <input type="text" class="form-control" id="insumoNombre" name="nombre" required>
                </div>
                <button type="submit" class="btn btn-success">Guardar insumo</button>
            </form>
        </div>

        <div id="productoForm" class="dynamic-form" style="display:none;">
            <h4>Crear Producto</h4>
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="productoNombre" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" id="productoNombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="insumosSelect" class="form-label">Insumos necesarios</label>
                    <select class="form-select" id="insumosSelect" name="insumos[]" multiple required>
                        @foreach($insumos as $insumo)
                            <option value="{{ $insumo->id }}">{{ $insumo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Guardar producto</button>
            </form>
        </div>

        <div id="historialClienteForm" class="dynamic-form" style="display:none;">
            <h4>Historial de Cliente</h4>
            <form id="clienteHistoryForm">
                <div class="mb-3">
                    <label for="clienteSelect" class="form-label">Selecciona cliente</label>
                    <select class="form-select" id="clienteSelect" name="cliente_id">
                        <option value="">Seleccionar...</option>
                        @foreach($cliente as $c)
                            <option value="{{ $c->id }}">{{ $c->nombre ?? 'Cliente ' . $c->id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="clienteObservacion" class="form-label">Observación</label>
                    <textarea class="form-control" id="clienteObservacion" name="observacion" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Guardar historial</button>
            </form>
        </div>

        <div id="historialProveedorForm" class="dynamic-form" style="display:none;">
            <h4>Historial de Proveedor</h4>
            <form id="proveedorHistoryForm">
                <div class="mb-3">
                    <label for="proveedorSelect" class="form-label">Selecciona proveedor</label>
                    <select class="form-select" id="proveedorSelect" name="proveedor_id">
                        <option value="">Seleccionar...</option>
                        @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre ?? 'Proveedor ' . $proveedor->id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="proveedorObservacion" class="form-label">Observación</label>
                    <textarea class="form-control" id="proveedorObservacion" name="observacion" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Guardar historial</button>
            </form>
        </div>
    </div>
</div>

<script>
const typeSelect = document.getElementById('objectType');
const forms = {
    insumo: document.getElementById('insumoForm'),
    producto: document.getElementById('productoForm'),
    historial_cliente: document.getElementById('historialClienteForm'),
    historial_proveedor: document.getElementById('historialProveedorForm')
};
const optionCards = document.querySelectorAll('.option-card');

function hideAllForms() {
    Object.values(forms).forEach(form => form.style.display = 'none');
    optionCards.forEach(card => card.classList.remove('active'));
}

function showForm(type) {
    hideAllForms();
    if (!type) return;
    const selected = forms[type];
    if (selected) {
        selected.style.display = 'block';
        document.querySelector(`.option-card[data-type="${type}"]`)?.classList.add('active');
    }
}

typeSelect.addEventListener('change', function () {
    showForm(this.value);
});

optionCards.forEach(card => {
    card.addEventListener('click', () => {
        const type = card.getAttribute('data-type');
        typeSelect.value = type;
        showForm(type);
    });
});

const placeholderForms = ['clienteHistoryForm', 'proveedorHistoryForm'];
placeholderForms.forEach(id => {
    document.getElementById(id).addEventListener('submit', function (event) {
        event.preventDefault();
        alert('Este formulario muestra la interfaz para historial y puede integrarse con el backend según sea necesario.');
    });
});
</script>
</body>
</html>
