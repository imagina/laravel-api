<?php

use Illuminate\Support\Facades\Route;
use Modules\Isetting\Http\Controllers\Api\SettingApiController;
// add-use-controller


Route::prefix('/isetting/v1')->group(function () {
    Route::apiCrud([
      'module' => 'isetting',
      'prefix' => 'settings',
      'controller' => SettingApiController::class,
      'permission' => 'isetting.settings',
      //'middleware' => ['create' => [], 'index' => [], 'show' => [], 'update' => [], 'delete' => [], 'restore' => []],
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
