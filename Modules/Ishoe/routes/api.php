<?php

use Illuminate\Support\Facades\Route;
use Modules\Ishoe\Http\Controllers\Api\ShoeApiController;
use Modules\Ishoe\Http\Controllers\Api\OptionApiController;
// add-use-controller



Route::prefix('/ishoe/v1')->group(function () {
    Route::apiCrud([
      'module' => 'ishoe',
      'prefix' => 'shoes',
      'controller' => ShoeApiController::class,
      'permission' => 'ishoe.shoes',
      'middleware' => ['create' => [], 'index' => [], 'show' => [], 'update' => [], 'delete' => [], 'restore' => []],
      // 'customRoutes' => [ // Include custom routes if needed
      //  [
      //    'method' => 'post', // get,post,put....
      //    'path' => '/some-path', // Route Path
      //    'uses' => 'ControllerMethodName', //Name of the controller method to use
      //    'middleware' => [] // if not set up middleware, auth:api will be the default
      //  ]
      // ]
    ]);
    Route::apiCrud([
      'module' => 'ishoe',
      'prefix' => 'options',
      'controller' => OptionApiController::class,
      'permission' => 'ishoe.options',
      'middleware' => ['create' => [], 'index' => [], 'show' => [], 'update' => [], 'delete' => [], 'restore' => []],
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
