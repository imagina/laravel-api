<?php

namespace Modules\Islider\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class Slider extends CoreModel
{

    protected $table = 'islider__sliders';
    public string $transformer = 'Modules\Islider\Transformers\SliderTransformer';
    public string $repository = 'Modules\Islider\Repositories\SliderRepository';
    public array $requestValidation = [
        'create' => 'Modules\Islider\Http\Requests\CreateSliderRequest',
        'update' => 'Modules\Islider\Http\Requests\UpdateSliderRequest',
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
    public array $translatedAttributes = [];
    protected $fillable = [
        'title',
        'system_name',
        'options',
        'active'
    ];

    protected $casts = [
        'options' => 'json',
    ];

    public function slides()
    {
        return $this->hasMany(Slide::class)->with('translations')->orderBy('position', 'asc');
    }

}
