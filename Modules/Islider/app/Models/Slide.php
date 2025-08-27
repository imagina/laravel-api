<?php

namespace Modules\Islider\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class Slide extends CoreModel
{
  use Translatable;

  protected $table = 'islider__slides';
  public string $transformer = 'Modules\Islider\Transformers\SlideTransformer';
  public string $repository = 'Modules\Islider\Repositories\SlideRepository';
  public array $requestValidation = [
    'create' => 'Modules\Islider\Http\Requests\CreateSlideRequest',
    'update' => 'Modules\Islider\Http\Requests\UpdateSlideRequest',
  ];
  //Instance external/internal events to dispatch with extraData
  public array $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [
      ['path' => 'Modules\Imedia\Events\CreateMedia']
    ],
    'creating' => [],
    'updated' => [
      ['path' => 'Modules\Imedia\Events\UpdateMedia']
    ],
    'updating' => [],
    'deleting' => [
      ['path' => 'Modules\Imedia\Events\DeleteMedia']
    ],
    'deleted' => []
  ];
  public array $translatedAttributes = [
    'title',
    'uri',
    'url',
    'active',
    'custom_html',
    'summary',
    'code_ads'
  ];
  protected $fillable = [
    'slider_id',
    'page_id',
    'sort_order',
    'target',
    'title',
    'caption',
    'uri',
    'url',
    'type',
    'active',
    'external_image_url',
    'custom_html',
    'responsive',
    'options'
  ];

  protected $casts = [
    'options' => 'json',
  ];

  /**
   * Media Fillable
   */
  public $mediaFillable = [
    'slideimage' => 'single'
  ];

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

  public function slider()
  {
    return $this->belongsTo(Slider::class);
  }

}
