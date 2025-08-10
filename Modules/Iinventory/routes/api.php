<?php

use Illuminate\Support\Facades\Route;
use Modules\Iinventory\Http\Controllers\Api\InventoryApiController;
use Modules\Iinventory\Http\Controllers\Api\InventoryItemApiController;
use Modules\Iinventory\Http\Controllers\Api\TransactionApiController;
// add-use-controller




Route::prefix('/iinventory/v1')->group(function () {
    Route::apiCrud([
      'module' => 'iinventory',
      'prefix' => 'inventories',
      'controller' => InventoryApiController::class,
      'permission' => 'iinventory.inventories',
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
      'module' => 'iinventory',
      'prefix' => 'inventoryitems',
      'controller' => InventoryItemApiController::class,
      'permission' => 'iinventory.inventoryitems',
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
      'module' => 'iinventory',
      'prefix' => 'transactions',
      'controller' => TransactionApiController::class,
      'permission' => 'iinventory.transactions',
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
