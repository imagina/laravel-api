<?php

namespace Modules\Itranslation\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class Translation extends CoreModel
{
    use Translatable;

    protected $table = 'itranslation__translations';
    public string $transformer = 'Modules\Itranslation\Transformers\TranslationTransformer';
    public string $repository = 'Modules\Itranslation\Repositories\TranslationRepository';
    public array $requestValidation = [
        'create' => 'Modules\Itranslation\Http\Requests\CreateTranslationRequest',
        'update' => 'Modules\Itranslation\Http\Requests\UpdateTranslationRequest',
    ];
    //Instance external/internal events to dispatch with extraData
    public array $dispatchesEventsWithBindings = [
        //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
        'created' => [],
        'creating' => [],
        'updated' => [],
        'updating' => [],
        'deleting' => [],
        'deleted' => []
    ];
    public array $translatedAttributes = [
        'value'
    ];
    protected $fillable = [
        'key',
        'value'
    ];
}
