<!DOCTYPE html>

<html lang="es">
<head>
<meta charset="UTF-8">
<title>Sistema de Gestión</title>
<link rel="stylesheet" href="{{ asset('css/design/Enter.css') }}">
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

<form action="{{ route('validate') }}" method="POST">
@csrf
<div class="mb-3">
<input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com" value="{{ old('email') }}" required>
@error('email')<span class="text-danger">{{ $message }}</span>@enderror
</div>

<div class="mb-3">
<input type="password" name="password" class="form-control" placeholder="********" required>
@error('password')<span class="text-danger">{{ $message }}</span>@enderror
</div>

<div class="d-grid">
<button type="submit" class="btn btn-success">Ingresar</button>
</div>

@if($errors->any())
    <div class="alert alert-danger mt-2">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif
</form>

</div>

</div>

<footer class="text-center text-white pb-3">
© derechos reservados @juanadmin
</footer>

</body>
</html>