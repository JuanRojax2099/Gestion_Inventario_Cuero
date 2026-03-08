<!DOCTYPE html>

<html lang="es">
<head>
<meta charset="UTF-8">
<title>Sistema de Gestión</title>

<link rel="stylesheet" href="{{ asset('css/bootstrap5.8.3/css/bootstrap.min.css') }}">
<style>

</style>

</head>

<body class="bg-dark text-white">

<div class="container vh-100 d-flex flex-column justify-content-center align-items-center">

<h1 class="mb-3 text-center">Marroquinería</h1>

<h4 class="mb-5 text-center text-success">
Sistema de gestión de procesos e insumos
</h4>

<div class="card p-4 shadow" style="width:350px">

<form method="GET" action="/landing">
@csrf
<div class="mb-3">
<label class="form-label">Correo</label>
<input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com">
</div>

<div class="mb-3">
<label class="form-label">Contraseña</label>
<input type="password" name="password" class="form-control" placeholder="********">
</div>

<div class="d-grid">
<button class="btn btn-success">Ingresar</button>
</div>

</form>

</div>

</div>

<footer class="text-center text-white pb-3">
© derechos reservados @juanadmin
</footer>

</body>
</html>