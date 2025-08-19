<?php

use Illuminate\Support\Facades\Route;
use Modules\Itranslation\Http\Controllers\Api\TranslationApiController;
// add-use-controller


Route::prefix('/itranslation/v1')->group(function () {
    Route::apiCrud([
      'module' => 'itranslation',
      'prefix' => 'translations',
      'controller' => TranslationApiController::class,
      'permission' => 'itranslation.translations',
      'middleware' => ['index' => [], 'show' => []],
      // 'customRoutes' => [ // Include custom routes if needed
      //  [
      //    'method' => 'post', // get,post,put....
      //    'path' => '/some-path', // Route Path
      //    'uses' => 'ControllerMethodName', //Name of the controller method to use
      //    'middleware' => [] // if not set up middleware, auth:api will be the default
      //  ]
      // ]
    ]);
// append

});
