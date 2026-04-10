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

<form id="loginForm">
@csrf
<div class="mb-3">
<label class="form-label">Correo</label>
<input type="email" id="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required>
</div>

<div class="mb-3">
<label class="form-label">Contraseña</label>
<input type="password" id="password" name="password" class="form-control" placeholder="********" required>
</div>

<div class="d-grid">
<button type="submit" class="btn btn-success">Ingresar</button>
</div>

</form>

</div>

</div>

<footer class="text-center text-white pb-3">
© derechos reservados @juanadmin

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    try {
        const response = await fetch('/api/validation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        });
        
        const data = await response.json();
        
        if(response.ok && data.token) {
            localStorage.setItem('auth_token', data.token);
            window.location.href = '/landing';
        } else {
            alert('Error: ' + data.message);
        }
    } catch(error) {
        console.error('Error:', error);
        alert('Error en la conexión');
    }
});
</script>
</footer>

</body>
</html>