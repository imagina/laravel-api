<?php

use Illuminate\Support\Facades\Route;
use Modules\Ilocation\Http\Controllers\Api\CountryApiController;
use Modules\Ilocation\Http\Controllers\Api\ProvinceApiController;
use Modules\Ilocation\Http\Controllers\Api\CityApiController;
use Modules\Ilocation\Http\Controllers\Api\LocatableApiController;
// add-use-controller

Route::prefix('/ilocation/v1')->group(function () {
    Route::apiCrud([
      'module' => 'ilocation',
      'prefix' => 'countries',
      'controller' => CountryApiController::class,
      'permission' => 'ilocation.countries',
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
      'module' => 'ilocation',
      'prefix' => 'provinces',
      'controller' => ProvinceApiController::class,
      'permission' => 'ilocation.provinces',
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
      'module' => 'ilocation',
      'prefix' => 'cities',
      'controller' => CityApiController::class,
      'permission' => 'ilocation.cities',
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
      'module' => 'ilocation',
      'prefix' => 'locatables',
      'controller' => LocatableApiController::class,
      'permission' => 'ilocation.locatables',
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
