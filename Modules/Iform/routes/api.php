<?php

use Illuminate\Support\Facades\Route;
use Modules\Iform\Http\Controllers\Api\BlockApiController;
use Modules\Iform\Http\Controllers\Api\FieldApiController;
use Modules\Iform\Http\Controllers\Api\FormApiController;
use Modules\Iform\Http\Controllers\Api\LeadApiController;
// add-use-controller

Route::prefix('/iform/v1')->group(function () {
  Route::apiCrud([
    'module' => 'iform',
    'prefix' => 'blocks',
    'controller' => BlockApiController::class,
    'permission' => 'iform.blocks',
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
    'module' => 'iform',
    'prefix' => 'fields',
    'controller' => FieldApiController::class,
    'permission' => 'iform.fields',
    'middleware' => ['index' => [], 'show' => []],
    'customRoutes' => [
      [
        'method' => 'post', // get,post,put....
        'path' => '/updateOrders', // Route Path
        'uses' => 'batchUpdate' //Name of the controller method to use
      ]
    ]
  ]);
  Route::apiCrud([
    'module' => 'iform',
    'prefix' => 'forms',
    'controller' => FormApiController::class,
    'permission' => 'iform.forms',
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
    'module' => 'iform',
    'prefix' => 'leads',
    'controller' => LeadApiController::class,
    'permission' => 'iform.leads',
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
  /**
   * STATICS CLASS
   */
  Route::apiCrud([
    'module' => 'iform',
    'prefix' => 'types',
    'staticEntity' => 'Modules\Iform\Models\Type',
    'middleware' => ['index' => [], 'show' => []]
  ]);
// append
});
