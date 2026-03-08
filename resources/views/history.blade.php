<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Historial Comercial</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>

.titulo{
color:#0b3d2e;
font-weight:bold;
}

.tabla-header{
background-color:#0b3d2e;
color:white;
}

</style>

</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="text-center titulo mb-4">Historial Comercial</h2>

<!-- HISTORIAL DE VENTAS A EMPRESAS MINORISTAS -->

<div class="card mb-4 shadow">

<div class="card-header tabla-header">
Ventas a Empresas Minoristas
</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-light">

<tr>
<th>ID</th>
<th>Empresa</th>
<th>NIT</th>
<th>Producto</th>
<th>Cantidad</th>
<th>Fecha</th>
<th>Total</th>
</tr>

</thead>

<tbody>

<tr>
<td>1</td>
<td>Moda Urbana SAS</td>
<td>901234567</td>
<td>Cartera de cuero</td>
<td>20</td>
<td>2026-03-01</td>
<td>$1.200.000</td>
</tr>

<tr>
<td>2</td>
<td>Accesorios Elegance</td>
<td>900765432</td>
<td>Bolsos artesanales</td>
<td>15</td>
<td>2026-03-05</td>
<td>$950.000</td>
</tr>

</tbody>

</table>

</div>

</div>

<!-- COMPRAS A PROVEEDORES -->

<div class="card shadow">

<div class="card-header tabla-header">
Compras a Proveedores
</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-light">

<tr>
<th>ID</th>
<th>Proveedor</th>
<th>Insumo</th>
<th>Cantidad</th>
<th>Fecha</th>
<th>Costo</th>
</tr>

</thead>

<tbody>

<tr>
<td>1</td>
<td>Cuero Premium SAS</td>
<td>Cuero natural</td>
<td>80 m²</td>
<td>2026-02-28</td>
<td>$1.400.000</td>
</tr>

<tr>
<td>2</td>
<td>Textiles Andinos</td>
<td>Hilo industrial</td>
<td>30 rollos</td>
<td>2026-03-03</td>
<td>$210.000</td>
</tr>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>