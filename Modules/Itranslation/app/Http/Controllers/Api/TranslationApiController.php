<?php

namespace Modules\Itranslation\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Itranslation\Models\Translation;
use Modules\Itranslation\Repositories\TranslationRepository;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TranslationApiController extends CoreApiController
{
    public function __construct(Translation $model, TranslationRepository $modelRepository)
    {
        parent::__construct($model, $modelRepository);
    }
}
