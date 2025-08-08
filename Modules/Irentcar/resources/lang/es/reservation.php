<?php

return [
    'single' => 'Reservacion',
    'button' => [],
    'messages' => [
        'pickupDateIsRequired' => 'La fecha y hora de recogida es obligatoria.',
        'pickupDateFormat' => 'El formato de la fecha y hora de recogida debe ser YYYY-MM-DD H:i.',
        'dropoffDateIsRequired' => 'La fecha y hora de devolucion es obligatoria.',
        'dropoffDateFormat' => 'El formato de la fecha y hora de devolucion debe ser YYYY-MM-DD H:i.',
        'pickupOfficeIdIsRequired' => 'La Oficina de Recogida es obligatoria',
        'pickupOfficeIdExists' => 'La Oficina de Recogida no existe.',
        'dropoffOfficeIdIsRequired' => 'La Oficina de Devolucion es obligatorio.',
        'dropoffOfficeIdExists' => 'La Oficina de Devolucion no existe.',
        'gammaIdIsRequired' => 'El Gama es obligatoria',
        'gammaIdExists' => 'La Gama no existe',
        'gammaOfficeIdIsRequired' => 'El ID de la relacion Gama Oficina es obligatorio.',
        'gammaOfficeIdExists' => 'La relacion Gama Oficina no existe.',
        'gammaOfficeExtraIdsMustBeJson' => 'Los extras deben ser un JSON valido.',
    ],
    'validation' => [],
    'status' => [
        'pending' => 'Pendiente',
        'approved' => 'Aprobado',
        'cancelled' => 'Cancelado',
    ],
    'email' => [
        'created' => [
            'title' => 'Reservacion Creada',
            'message' => ' Se ha creado una reservacion'
        ]
    ]
];
