<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel principal</title>

<link rel="stylesheet" href="{{ asset('css/bootstrap5.8.3/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/design/landing.css') }}">


</head>

<body>

<div class="header d-flex justify-content-between align-items-center px-4">
<h2>Sistema de Gestión de Marroquinería</h2>

<div class="col col-sm-3">

    <button class="btn btn-crear ml-1" data-bs-toggle="modal" data-bs-target="#createModal">Crear nueva instancia</button>
    <div class="btn btn-logout md-1">
        <a href="{{route('logout')}}" class="text text-black text-decoration-none">Cerrar sesión</a>
    </div>
</div>
</div>


<div class="container mt-5">

<div class="row text-center">

<div class="col-md-4 mb-4">
<div class="card card-menu shadow">
<div class="card-body">
<h5>Calendario de Producción</h5>
<p>Ver fechas de producción y entregas.</p>
<a href="/calendario" class="btn btn-success">Abrir</a>
</div>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card card-menu shadow">
<div class="card-body">
<h5>Historial de Compras</h5>
<p>Ver compras de clientes y proveedores.</p>
<a href="/historial" class="btn btn-success">Abrir</a>
</div>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card card-menu shadow">
<div class="card-body">
<h5>Inventario</h5>
<p>Administrar insumos y productos.</p>
<a href="/inventario" class="btn btn-success">Abrir</a>
</div>
</div>
</div>

</div>

</div>

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Crear Nueva Instancia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="createForm">
          <div class="mb-3">
            <label for="typeSelect" class="form-label">Tipo</label>
            <select class="form-select" id="typeSelect" name="type" required>
              <option value="">Seleccionar...</option>
              <option value="insumo">Crear insumo</option>
              <option value="producto">Producto</option>
            </select>
          </div>
          <div id="insumoFields" style="display: none;">
            <div class="mb-3">
              <label for="insumoNombre" class="form-label">Nombre del Insumo</label>
              <input type="text" class="form-control" id="insumoNombre" name="nombre" required>
            </div>
          </div>
          <div id="productoFields" style="display: none;">
            <div class="mb-3">
              <label for="productoNombre" class="form-label">Nombre del Producto</label>
              <input type="text" class="form-control" id="productoNombre" name="nombre" required>
            </div>
            <div class="mb-3">
              <label for="insumosSelect" class="form-label">Insumos Necesarios</label>
              <select class="form-select" id="insumosSelect" name="insumos[]" multiple required>
                @foreach($insumos as $insumo)
                  <option value="{{ $insumo->id }}">{{ $insumo->nombre }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Crear</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('typeSelect').addEventListener('change', function() {
  const type = this.value;
  document.getElementById('insumoFields').style.display = type === 'insumo' ? 'block' : 'none';
  document.getElementById('productoFields').style.display = type === 'producto' ? 'block' : 'none';
});

document.getElementById('createForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  const type = formData.get('type');
  let url, data;
  if (type === 'insumo') {
    url = '{{ route("insumos.store") }}';
    data = {
      nombre: formData.get('nombre'),
      _token: '{{ csrf_token() }}'
    };
  } else if (type === 'producto') {
    url = '{{ route("productos.store") }}';
    data = {
      nombre: formData.get('nombre'),
      insumos: formData.getAll('insumos[]'),
      _token: '{{ csrf_token() }}'
    };
  }
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data)
  })
  .then(response => response.json())
  .then(data => {
    alert('Creado exitosamente');
    location.reload();
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Error al crear');
  });
});
</script>

</body>
</html>