# imaginacms-ifillable

## Implementation with Modules

### In the Entity (Models/Entity)

- Add Events

```php
 public $dispatchesEventsWithBindings = [
        'created' => [
            ['path' => 'Modules\Ifillable\Events\CreateField']
        ],
        'creating' => [],
        'updated' => [
            ['path' => 'Modules\Ifillable\Events\CreateField']
        ],
        'updating' => [],
        'deleting' => [
            ['path' => 'Modules\Ifillable\Events\CreateField']
        ],
        'deleted' => []
    ];
```

- Add relation:

```php
public function fields()
    {
        if (isModuleEnabled('Ifillable')) {
            return app(\Modules\Ifillable\Relations\FillablesRelation::class)->resolve($this);
        }
        return new \Imagina\Icore\Relations\EmptyRelation();
    }
```

[//]: # (### In Transformer  &#40;Transformers/EntityTransformer&#41;)

[//]: # ()
[//]: # (- Add relation with files)

[//]: # ()
[//]: # (``` php)

[//]: # (//Implementation with Media)

[//]: # ( return [)

[//]: # (    'files' => $this->whenLoaded&#40;'files', fn&#40;&#41; => $this->files->byZones&#40;$this->mediaFillable, $this&#41;&#41;,)

[//]: # (];)

[//]: # (```)
