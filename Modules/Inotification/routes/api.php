<?php

use Illuminate\Support\Facades\Route;
use Modules\Inotification\Http\Controllers\Api\NotificationApiController;
use Modules\Inotification\Http\Controllers\Api\ProviderApiController;
use Modules\Inotification\Http\Controllers\Api\NotificationTypeApiController;
use Modules\Inotification\Http\Controllers\Api\DeviceApiController;
// add-use-controller





Route::prefix('/inotification/v1')->group(function () {
    Route::apiCrud([
      'module' => 'inotification',
      'prefix' => 'notifications',
      'controller' => NotificationApiController::class,
      'permission' => 'inotification.notifications',
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
      'module' => 'inotification',
      'prefix' => 'providers',
      'controller' => ProviderApiController::class,
      'permission' => 'inotification.providers',
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
      'module' => 'inotification',
      'prefix' => 'notificationtypes',
      'controller' => NotificationTypeApiController::class,
      'permission' => 'inotification.notificationtypes',
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
      'module' => 'inotification',
      'prefix' => 'devices',
      'controller' => DeviceApiController::class,
      'permission' => 'inotification.devices',
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
