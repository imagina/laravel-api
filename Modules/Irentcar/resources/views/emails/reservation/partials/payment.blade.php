<h3 style="font-size: 14px; margin-top: 20px; color: #000000;">A pagar a la llegada</h3>
<p style="margin: 0; color: #000;">Tarifa básica <span style="color: #28a745;">${{ $reservation->gamma_office_price }}
        COP</span></p>
<p style="margin: 0; color: #555;">Impuesto sobre las ventas ({{ $reservation->tax_rate }}%) (Incluido)</p>

<h3 style="font-size: 14px; margin-top: 20px; color: #000000;">Precio total estimado</h3>
<p style="margin: 0; font-weight: bold; color: #28a745;">
    ${{ $reservation->total_price}} COP</p>
<p style="margin: 0; color: #000;">A pagar a la llegada</p>
<p style="margin: 0; color: #000;"><strong>$ {{ $reservation->total_price_usd }} USD</strong>
    ({{ $reservation->total_price }} COP)</p>


<p style="margin: 10px 0; color: #555;">
    El precio COP que se muestra se convierte de la moneda de su destino a USD, y está sujeto a modificaciones en
    función de las variaciones del tipo de divisa.
</p>

<p style="margin: 10px 0; color: #000;"><strong>Con este vehículo puede recorrer un kilometraje ilimitado</strong>
</p>