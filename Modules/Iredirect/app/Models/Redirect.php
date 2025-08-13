<?php

namespace Modules\Iredirect\Models;

use Imagina\Icore\Models\CoreModel;

class Redirect extends CoreModel
{

  protected $table = 'iredirect__redirects';
  public string $transformer = 'Modules\Iredirect\Transformers\RedirectTransformer';
  public string $repository = 'Modules\Iredirect\Repositories\RedirectRepository';
  public array $requestValidation = [
    'create' => 'Modules\Iredirect\Http\Requests\CreateRedirectRequest',
    'update' => 'Modules\Iredirect\Http\Requests\UpdateRedirectRequest',
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

  protected $fillable = [
    'from',
    'to',
    'redirect_type',
    'options'
  ];

  protected $casts = [
    'options' => 'json'
  ];

}
