<?php

use Illuminate\Support\Facades\Route;
use Modules\Ilocations\Http\Controllers\Api\CountryApiController;
use Modules\Ilocations\Http\Controllers\Api\ProvinceApiController;
use Modules\Ilocations\Http\Controllers\Api\CityApiController;
use Modules\Ilocations\Http\Controllers\Api\LocatableApiController;
// add-use-controller





Route::prefix('/ilocations/v1')->group(function () {
    Route::apiCrud([
      'module' => 'ilocations',
      'prefix' => 'countries',
      'controller' => CountryApiController::class,
      'permission' => 'ilocations.countries',
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
      'module' => 'ilocations',
      'prefix' => 'provinces',
      'controller' => ProvinceApiController::class,
      'permission' => 'ilocations.provinces',
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
      'module' => 'ilocations',
      'prefix' => 'cities',
      'controller' => CityApiController::class,
      'permission' => 'ilocations.cities',
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
      'module' => 'ilocations',
      'prefix' => 'locatables',
      'controller' => LocatableApiController::class,
      'permission' => 'ilocations.locatables',
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
