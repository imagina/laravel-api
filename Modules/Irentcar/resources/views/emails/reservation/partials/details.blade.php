<h2 style="font-size: 25px; margin-bottom: 10px; color: #0000000;">Detalles de la reserva</h2>

<p style="margin: 0; color: #000;"><strong>Número de confirmación:</strong> {{ $reservation->id}}
</p>
<p style="margin: 10px 0; color: #555;">
    Se ha completado su reserva. Anote su número de confirmación. Si ha introducido una dirección de correo
    electrónico válida, recibirá una confirmación de esta reserva. Compruebe la carpeta de correo no deseada.
</p>

<hr>

<h2 style="font-size: 14px; margin-bottom: 10px; color: #0000000;">Detalles de la reserva</h2>

<h3 style="font-size: 14px; margin-top: 20px; color: #0000000;">Fecha y hora de la recogida</h3>
<p style="margin: 0; color: #000;">{{ $reservation->pickup_date->format('l, d/m/Y - H:i') }}</p>

<h3 style="font-size: 14px; margin-top: 10px; color: #0000000;">Fecha y hora de la devolución</h3>
<p style="margin: 0; color: #000;">{{ $reservation->dropoff_date->format('l, d/m/Y - H:i') }}</p>

<h3 style="font-size: 14px; margin-top: 10px; color: #0000000;">Oficina de recogida</h3>
<p style="margin: 0; color: #000;">{{ $reservation->pickupOffice->title }}</p>

<h3 style="font-size: 14px; margin-top: 10px; color: #0000000;">Oficina de devolucion</h3>
<p style="margin: 0; color: #000;">{{ $reservation->dropoffOffice->title }}</p>

<hr>