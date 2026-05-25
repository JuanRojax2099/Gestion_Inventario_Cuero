<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel principal</title>

<link rel="stylesheet" href="{{ asset('css/bootstrap5.8.3/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/design/landing.css') }}">


</head>

<body class="bg-dark">

<div class="header d-flex justify-content-between align-items-center px-4">
<h2>Sistema de Gestión de Marroquinería</h2>

<div class="col col-sm-3">
    <a href="{{ route('supplier.createobject') }}" class="btn btn-crear ml-1">Crear nueva instancia</a>
    <div class="btn btn-logout md-1">
        <a href="{{ route('logout') }}" class="text text-black text-decoration-none">Cerrar sesión</a>
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

</body>
</html>