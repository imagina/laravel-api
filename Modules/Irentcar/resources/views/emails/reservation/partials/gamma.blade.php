@php
    use Modules\Irentcar\Transformers\GammaTransformer;

    //Get Gamma
    $gamma = $reservation->gamma;
    //Check Relation Files
    $gamma->loadMissing('files');
    //Transform Data to include relation Files with data
    $gammaTransformed = (new GammaTransformer($gamma))->toArray(request());
    $filesByZone = $gammaTransformed['files'] ?? [];

@endphp

<h3 style="font-size: 14px; margin-top: 20px; color: #000000;">Información del vehículo</h3>

<p style="margin: 0; color: #000;">{{ $reservation->gamma->title }}</p>
<p style="margin: 0; color: #000;">{{ $reservation->gamma->passengers_number }} Pasajeros</p>
<p style="margin: 0; color: #000;">{{ $reservation->gamma->luggages }} maletas</p>


@if(!empty($filesByZone) && isset($filesByZone->mainimage))
    <img src="{{ $filesByZone->mainimage->thumbnails->smallThumb}}" alt="Imagen del vehículo" style="max-width: 200px;">
@endif


<h3 style="font-size: 14px; margin-top: 20px; color: #000000;">Elementos opcionales</h3>
@foreach ($reservation->extras_data as $extra)

    <p style="margin: 0; color: #000;">{{ $extra['extra']['title'] }}
    <p>{{ $extra['extra']['description'] }}</p>
    <span style="color: #28a745;">${{$extra['price']}} COP</span>
    </p>
@endforeach

<hr>