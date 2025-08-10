<?php

namespace Modules\Ishoe\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;

class Shoe extends CoreModel
{
  use Translatable;

  protected $table = 'ishoe__shoes';
  public string $transformer = 'Modules\Ishoe\Transformers\ShoeTransformer';
  public string $repository = 'Modules\Ishoe\Repositories\ShoeRepository';
  public array $requestValidation = [
      'create' => 'Modules\Ishoe\Http\Requests\CreateShoeRequest',
      'update' => 'Modules\Ishoe\Http\Requests\UpdateShoeRequest',
    ];
  public $modelRelations = [
    'options' => 'belongsToMany',
    'users' => 'belongsToMany',
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
  protected $fillable = ['reference', 'price'];

  public function options(){
    return $this->belongsToMany(Option::class, 'ishoe__shoe_options');
  }

  public function users(){
    return $this->belongsToMany('Modules\Iuser\Models\User', 'ishoe__user_products')->withPivot('price');
  }
}
