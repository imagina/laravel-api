# imaginacms-ilocations

## Implementation with Modules

### In the Entity (Models/Entity)

- Add Events

```php
 public array $dispatchesEventsWithBindings = [
    'created' => [['path' => 'Modules\Ilocations\Events\CreateLocation']],
    'creating' => [],
    'updated' => [['path' => 'Modules\Ilocations\Events\UpdateLocation']],
    'updating' => [],
    'deleting' => [['path' => 'Modules\Ilocations\Events\DeleteLocation']],
    'deleted' => []
];
```

- Add relation:

```php
public function locations()
{
    if (isModuleEnabled('Ilocations')) {
        return app(\Modules\Ilocations\Relations\LocationsRelation::class)->resolve($this);
    }
    return new \Imagina\Icore\Relations\EmptyRelation();
}
```

- Post Locatable:

```
"locatable": {
    "city_id": 1,
    "country_id": 1,
    "province_id": 1,
    "address": "calle 1 #2-3"
    "lat": "-142.545469874",
    "lng": "85.639821"
}
```
