<?php

return [
    /**
     * Used with Inotification
     * http://exampleurl.com/inotification/v1/preview-email?config=imodule.entityTestEmail
     */
    'reservationTestEmail' => [
        "title" =>  "irentcar::reservation.email.created.title",
        "message" => 'El mensaje',
        "content" => "irentcar::emails.reservation.index",
        "extraParams" => [
            'reservation' => fn() => Modules\Irentcar\Models\Reservation::find(1),
        ],
    ]
];
