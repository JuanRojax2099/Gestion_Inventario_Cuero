<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Calendario de Producción</title>

<link rel="stylesheet" href="{{ asset('css/bootstrap5.8.3/css/bootstrap.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

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

        events: function(info, successCallback, failureCallback) {
            fetch('/entregas')
                .then(response => response.json())
                .then(data => successCallback(data))
                .catch(error => {
                    console.error('Error al cargar entregas:', error);
                    failureCallback(error);
                });
        },

        eventClick: function(info) {
            eventoSeleccionado = info.event;
            alert("Evento seleccionado: " + info.event.title + "\nCliente: " + info.event.extendedProps.cliente + "\nFactura: " + info.event.extendedProps.factura_id);
        }

    });

    calendar.render();

});


function crearEntrega(){

    let titulo = prompt("Nombre del cliente:");
    let fecha = prompt("Fecha (YYYY-MM-DD):");

    if(titulo && fecha){

        fetch('/entregas', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                factura_id: 1,
                fecha: fecha,
                cliente: titulo
            })
        })
        .then(res => res.json())
        .then(data => {

            calendar.refetchEvents();

        });

    }
}


function eliminarEntrega(){

    if(eventoSeleccionado){

        let id = eventoSeleccionado.id;

        fetch('/entregas/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(() => {
            eventoSeleccionado.remove();
            eventoSeleccionado = null;
            alert("Entrega eliminada");
        });

    }else{
        alert("Selecciona primero un evento");
    }

}

</script>

</body>
</html>