<?php

namespace Modules\Iform\Http\Controllers\Api;

use Imagina\Icore\Http\Controllers\CoreApiController;
//Model
use Modules\Iform\Models\Field;
use Modules\Iform\Repositories\FieldRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class FieldApiController extends CoreApiController
{
  public function __construct(Field $model, FieldRepository $modelRepository)
  {
    parent::__construct($model, $modelRepository);
  }

  public function batchUpdate(Request $request): JsonResponse
  {
    DB::beginTransaction();
    try {
      $params = $this->getParamsRequest($request);

      $data = $request->input('attributes');

      //Update data
      $newData = $this->modelRepository->updateOrders($data);
      //Response
      $response = ['data' => 'updated items'];
      DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      DB::rollback();//Rollback to Data Base
      [$status, $response] = $this->getErrorResponse($e);
    }
    return response()->json($response, $status ?? 200);
  }

}
