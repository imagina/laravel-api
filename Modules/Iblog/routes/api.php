<?php

use Illuminate\Support\Facades\Route;
use Modules\Iblog\Http\Controllers\Api\CategoryApiController;
use Modules\Iblog\Http\Controllers\Api\PostApiController;
// add-use-controller



Route::prefix('/iblog/v1')->group(function () {
    Route::apiCrud([
      'module' => 'iblog',
      'prefix' => 'categories',
      'controller' => CategoryApiController::class,
      'permission' => 'iblog.categories',
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
    Route::apiCrud([
      'module' => 'iblog',
      'prefix' => 'posts',
      'controller' => PostApiController::class,
      'permission' => 'iblog.posts',
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
