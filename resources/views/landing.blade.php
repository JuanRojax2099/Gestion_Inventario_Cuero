<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel principal</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>

body{
background-color:#f4f6f5;
}

.header{
background-color:#0b3d2e;
color:white;
padding:20px;
text-align:center;
}

.card-menu{
transition:0.3s;
}

.card-menu:hover{
transform:scale(1.05);
}

</style>

</head>

<body>

<div class="header">
<h2>Sistema de Gestión de Marroquinería</h2>
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
<a href="#" class="btn btn-success">Abrir</a>
</div>
</div>
</div>

</div>

</div>

</body>
</html>