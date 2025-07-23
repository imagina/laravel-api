# imaginacms-inotification


## SEED MODULE (Providers)

```php
php artisan module:seed Inotification
```

## Implements notifications in Modules

### In Module Entity Events

1. In the Model->dispatchesEventsWithBindings add the [path] and [extraData] attributes in the event.
Example: Send a notification after the model is updated:

```php
 public $dispatchesEventsWithBindings = [
        //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
        'created' => [],
        'creating' => [],
        'updated' => [[
            'path' => 'Modules\Inotification\Events\SendNotification',
            'extraData' => ['event' => 'updated']
        ]],
        'updating' => [],
        'deleting' => [],
        'deleted' => []
    ];
```

2. In the model, add the method getNotificableParams(), and inside that attributes that you need to change.
Example:
```php

/**
* Notification Params
*/
public function getNotificableParams()
{
    //Process to get Email (Example: From entity, or settings, etc)
    $email = 'emailto@example.com';

    return [
        'created' => [
            "email" => $email,
            "title" =>  itrans("iuser::users.email.created.title"),
            "message" => itrans("iuser::users.email.created.messages")
        ],
        'updated' => [
            "email" => $email,
            "title" => itrans("iuser::users.email.updated.title"),
            "message" => itrans("iuser::users.email.updated.messages")
        ],
        'deleted' => [
            "email" => $email,
            "title" => itrans("iuser::users.email.deleted.title"),
            "message" => itrans("iuser::users.email.deleted.messages")
        ],
    ];
}
```


### Call directly

- You can directly use the service to send a notification. Example:

```php

use Modules\Inotification\Services\NotificationDispatcherService;

$data = [
    'title' => itrans("inotification::notification.email.default.title"),
    'message' => itrans("inotification::notification.email.default.message"),
    'email' => 'emailto@example.com'
];

 app(NotificationDispatcherService::class)->execute($data);

```

## View Default Layout

You can view the email design (default) by accessing this path:

```php
http://exampleurl.com/inotification/v1/preview-email
```

If in addition to displaying it, you also need it to be sent, you can add the email attribute:
```php
http://exampleurl.com/inotification/v1/preview-email?email=example@email.com
```

You can also use a module's config to load a specific view with its data.
```php
http://exampleurl.com/inotification/v1/preview-email?config=imodule.entityTestEmail
```

Important: Only works for the LOCAL environment
