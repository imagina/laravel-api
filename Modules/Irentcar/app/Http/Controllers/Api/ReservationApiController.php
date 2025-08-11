<?php

namespace Modules\Irentcar\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Irentcar\Models\Reservation;
use Modules\Irentcar\Repositories\ReservationRepository;

use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

use Imagina\Icore\Traits\Controller\CoreApiControllerHelpers;
use Modules\Irentcar\Services\ValidationDateService;

class ReservationApiController extends CoreApiController
{
  use CoreApiControllerHelpers;

  private $validationDateService;
  public function __construct(Reservation $model, ReservationRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }

  /**
   * Validation Dates
   * @return mixed
   */
  public function validationDate(Request $request, ValidationDateService $validationDateService): JsonResponse
  {
    try {

      //Get Parameters from request
      $params = $this->getParamsRequest($request);

      //Get Data
      $modelData = $request->input('attributes') ?? [];

      //Validate Request
      $this->validateWithModelRules($modelData, 'validationDate');

      //Response
      $response = ['data' => $validationDateService->init($modelData)];

      //if ($params->page) $response['meta'] = ['page' => $this->pageTransformer($models)];
    } catch (Exception $e) {
      [$status, $response] = $this->getErrorResponse($e);
    }

    //Return response
    return response()->json($response, $status ?? Response::HTTP_OK);
  }
}
