<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Calendario de Producción</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<style>

.btn-verde{
background-color:#0b3d2e;
color:white;
border:none;
}

.btn-verde:hover{
background-color:#145c45;
color:white;
}

</style>

</head>

<body class="bg-light">

<div class="container mt-4">

<h2 class="text-center mb-4">Calendario de Producción y Entregas</h2>

<div class="mb-3 text-end">
<button class="btn btn-verde" onclick="crearEntrega()">Crear entrega</button>
<button class="btn btn-verde" onclick="eliminarEntrega()">Eliminar entrega</button>
</div>

<div id="calendar"></div>

</div>

<script>

let calendar;
let eventoSeleccionado = null;

document.addEventListener('DOMContentLoaded', function () {

var calendarEl = document.getElementById('calendar');

calendar = new FullCalendar.Calendar(calendarEl, {

initialView: 'dayGridMonth',

locale: 'es',

events: [

{
title: 'Inicio producción - Carteras',
start: '2026-03-10',
color: '#0b3d2e'
},

{
title: 'Entrega Cliente A',
start: '2026-03-15',
color: '#2e7d32'
}

],

eventClick: function(info) {

eventoSeleccionado = info.event;

alert("Evento seleccionado: " + info.event.title);

}

});

calendar.render();

});

function crearEntrega(){

let titulo = prompt("Nombre de la entrega o producción:");
let fecha = prompt("Fecha (YYYY-MM-DD):");

if(titulo && fecha){

calendar.addEvent({
title: titulo,
start: fecha,
color: "#2e7d32"
});

}

}

function eliminarEntrega(){

if(eventoSeleccionado){
eventoSeleccionado.remove();
eventoSeleccionado = null;
alert("Entrega eliminada");
}else{
alert("Selecciona primero un evento del calendario");
}

}

</script>

</body>
</html>