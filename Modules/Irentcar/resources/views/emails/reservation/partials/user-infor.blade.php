@php
    $user = $reservation->user;
    $fields = $user->fields;
@endphp

<h3 style="font-size: 14px; margin-top: 20px; color: #0000000;">Información del titular del contrato</h3>
<p style="margin: 0; color: #000;"><strong>Nombre:</strong> {{ $user->first_name }}
    {{ $user->last_name }}
</p>
<p style="margin: 0; color: #000;"><strong>Correo electrónico:</strong> {{ $user->email }}</p>

@foreach ($fields as $field)
    <p style="margin: 0; color: #000;"><strong>{{$field->title}}: </strong>{{$field->value}}</p>
@endforeach

<hr>