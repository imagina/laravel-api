<?php

use Illuminate\Support\Facades\Route;
use Modules\Islider\Http\Controllers\Api\SliderApiController;
use Modules\Islider\Http\Controllers\Api\SlideApiController;


Route::prefix('/islider/v1')->group(function () {
    Route::apiCrud([
      'module' => 'islider',
      'prefix' => 'sliders',
      'controller' => SliderApiController::class,
      'permission' => 'islider.sliders',
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
    Route::apiCrud([
      'module' => 'islider',
      'prefix' => 'slides',
      'controller' => SlideApiController::class,
      'permission' => 'islider.slides',
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
