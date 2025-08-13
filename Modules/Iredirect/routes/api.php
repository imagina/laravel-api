<?php

use Illuminate\Support\Facades\Route;
use Modules\Iredirect\Http\Controllers\Api\RedirectApiController;
// add-use-controller


Route::prefix('/iredirect/v1')->group(function () {
    Route::apiCrud([
      'module' => 'iredirect',
      'prefix' => 'redirects',
      'controller' => RedirectApiController::class,
      'permission' => 'iredirect.redirects',
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
