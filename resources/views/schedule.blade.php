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
<!-- Botones para crear y eliminar entregas -->
<div class="mb-3 text-end">
<button class="btn btn-verde" onclick="crearEntrega()">Crear entrega</button>
<button class="btn btn-verde" onclick="eliminarEntrega()">Eliminar entrega</button><!-- Eliminar Boton de "Eliminar entrega" -->
</div>

<div id="calendar"></div>

<div id="entrega-details" class="mt-4 p-3 bg-white rounded shadow-sm" style="display:none;">
    <h5>Detalle de entrega seleccionada</h5>
    <p id="detalle-entrega-text" class="mb-2">Selecciona un día con entrega para ver la información.</p>
    <button id="btn-ver-factura" type="button" class="btn btn-primary btn-sm" onclick="verFacturaSeleccionada()" disabled>Ver factura</button>
</div>

<div id="factura-details" class="mt-3 p-3 bg-white rounded shadow-sm" style="display:none;">
    <h5>Detalle de factura</h5>
    <p id="detalle-factura-text"></p>
</div>

</div>

<script>
//Javascript
//Crer boton en la misma cuadricula: "Eliminar esta entrega?"
let calendar;
let eventoSeleccionado = null;
let entregaSeleccionada = null;
let entregasCalendario = [];

document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',
        locale: 'es',

        events: function(info, successCallback, failureCallback) {
            fetch('/api/entregas')
                .then(response => response.json())
                .then(data => {
                    entregasCalendario = data;
                    successCallback(data);
                })
                .catch(error => {
                    console.error('Error al cargar entregas:', error);
                    failureCallback(error);
                });
        },

        eventClick: function(info) {
            eventoSeleccionado = info.event;
            entregaSeleccionada = {
                id: info.event.id,
                cliente: info.event.extendedProps.cliente,
                factura_id: info.event.extendedProps.factura_id,
                fecha: info.event.extendedProps.fecha,
                title: info.event.title
            };
            mostrarDetalleEntrega(entregaSeleccionada);
        },

        dateClick: function(info) {
            const fecha = info.dateStr;
            const entrega = entregasCalendario.find(e => e.date === fecha);
            if(entrega){
                entregaSeleccionada = entrega;
                mostrarDetalleEntrega(entregaSeleccionada);
            } else {
                entregaSeleccionada = null;
                mostrarDetalleEntrega(null, fecha);
            }
        }

    });

    calendar.render();

});

function mostrarDetalleEntrega(entrega, fecha = null){
    const detalles = document.getElementById('entrega-details');
    const texto = document.getElementById('detalle-entrega-text');
    const btnFactura = document.getElementById('btn-ver-factura');
    const detallesFactura = document.getElementById('factura-details');
    const textoFactura = document.getElementById('detalle-factura-text');

    detallesFactura.style.display = 'none';
    textoFactura.innerHTML = '';

    if(entrega){
        detalles.style.display = 'block';
        texto.innerHTML = '<strong>Entrega:</strong> ' + entrega.title + '<br>' +
            '<strong>Cliente:</strong> ' + entrega.cliente + '<br>' +
            '<strong>Fecha:</strong> ' + entrega.fecha + '<br>' +
            '<strong>Factura ID:</strong> ' + entrega.factura_id;
        btnFactura.disabled = false;
    } else {
        detalles.style.display = 'block';
        texto.innerHTML = '<strong>No hay entrega registrada para el día ' + (fecha || '') + '.</strong>';
        btnFactura.disabled = true;
    }
}

function verFacturaSeleccionada(){
    if(!entregaSeleccionada || !entregaSeleccionada.factura_id){
        alert('Primero selecciona una entrega con factura válida.');
        return;
    }

    fetch('/api/facturas/' + entregaSeleccionada.factura_id)
        .then(response => response.json())
        .then(data => {
            if(data.status === 404){
                alert('Factura no encontrada.');
                return;
            }
            const detallesFactura = document.getElementById('factura-details');
            const textoFactura = document.getElementById('detalle-factura-text');
            detallesFactura.style.display = 'block';
            textoFactura.innerHTML = '<strong>ID factura:</strong> ' + data.id + '<br>' +
                '<strong>Proveedor:</strong> ' + (data.proveedor || 'N/A') + '<br>' +
                '<strong>Fecha:</strong> ' + (data.fecha || 'N/A') + '<br>' +
                '<strong>Detalles:</strong> ' + (data.detalles || 'N/A');
        })
        .catch(error => {
            console.error('Error al cargar factura:', error);
            alert('No se pudo cargar la factura.');
        });
}

function crearEntrega(){

    let titulo = prompt("Nombre del cliente:");
    let fecha = prompt("Fecha (YYYY-MM-DD):");

    if(titulo && fecha){

        fetch('/api/entregas', {
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

        fetch('/api/entregas/' + id, {
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