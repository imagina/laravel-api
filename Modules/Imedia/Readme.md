# imaginacms-imedia

## Private Files Configurations
    - The bucker must have the permissions configured correctly
    - Read and write should be set only for the allowed user


## Implementation with Modules

### In the Entity (Models/Entity)

- Add Events

```php
 public array $dispatchesEventsWithBindings = [
    'created' => [['path' => 'Modules\Imedia\Events\CreateMedia']],
    'creating' => [],
    'updated' => [['path' => 'Modules\Imedia\Events\UpdateMedia']],
    'updating' => [],
    'deleting' => [['path' => 'Modules\Imedia\Events\DeleteMedia']],
    'deleted' => []
];
```

- Add the zones and replace "entity" with the name of the entity

```php
/**
* Media Fillable
*/
public $mediaFillable = [
    'entity' => [
        'mainimage' => 'single'
    ]
];
```

- Add relation:

```php
/**
* Relation Media
* Make the Many To Many Morph
*/
public function files()
{
    if (isModuleEnabled('Imedia')) {
        return app(\Modules\Imedia\Relations\FilesRelation::class)->resolve($this);
    }
    return new \Imagina\Icore\Relations\EmptyRelation();
}
```

### In Transformer  (Transformers/EntityTransformer)

- Add relation with files

``` php
//Implementation with Media
 return [
    'files' => $this->whenLoaded('files', fn() => $this->files->byZones($this->mediaFillable, $this)),
];
```
