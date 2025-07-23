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
public function files()
{
    if (isModuleEnabled('Ilocations')) {
        return app(\Modules\Ilocations\Relations\LocationsRelation::class)->resolve($this);
    }
    return new \Imagina\Icore\Relations\EmptyRelation();
}
```
