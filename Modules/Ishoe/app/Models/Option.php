<?php

namespace Modules\Ishoe\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class Option extends CoreModel
{
  use Translatable;

  protected $table = 'ishoe__options';
  public string $transformer = 'Modules\Ishoe\Transformers\OptionTransformer';
  public string $repository = 'Modules\Ishoe\Repositories\OptionRepository';
  public array $requestValidation = [
      'create' => 'Modules\Ishoe\Http\Requests\CreateOptionRequest',
      'update' => 'Modules\Ishoe\Http\Requests\UpdateOptionRequest',
    ];
  public $modelRelations = [
    'shoes' => 'belongsToMany'
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

  public array $translatedAttributes = ['title'];
  protected $fillable = ['price', 'parent_id', 'pieces', 'need_cutting', 'is_editable'];

  public function shoes(){
    $this->belongsToMany(Shoe::class, 'ishoe__shoe_options');
  }
}
