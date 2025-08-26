<?php

namespace Modules\Itranslation\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;

//Model
use Modules\Itranslation\Models\Translation;
use Modules\Itranslation\Repositories\TranslationRepository;


use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Exception;
use Modules\Itranslation\Transformers\TranslationTransformer;

class TranslationApiController extends CoreApiController
{
  public function __construct(Translation $model, TranslationRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }

  /**
   * Controller To request all model data
   *
   * @return mixed
   */
  public function getAll(Request $request): JsonResponse
  {
    try {
      //Get Parameters from request
      $params = $this->getParamsRequest($request);
      $allModulesTrans = $this->modelRepository->getAllTranslations($params);

      //Response
      $response = ['data' => TranslationTransformer::collection($allModulesTrans)];
    } catch (Exception $e) {
      [$status, $response] = $this->getErrorResponse($e);
    }

    //Return response
    return response()->json($response, $status ?? Response::HTTP_OK);

  }
}
