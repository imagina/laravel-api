<?php

use Illuminate\Support\Facades\Route;
use Modules\Irentcar\Http\Controllers\Api\OfficeApiController;
use Modules\Irentcar\Http\Controllers\Api\GammaApiController;
use Modules\Irentcar\Http\Controllers\Api\ExtraApiController;
use Modules\Irentcar\Http\Controllers\Api\GammaOfficeApiController;
use Modules\Irentcar\Http\Controllers\Api\DailyAvailabilityApiController;
use Modules\Irentcar\Http\Controllers\Api\GammaOfficeExtraApiController;
use Modules\Irentcar\Http\Controllers\Api\ReservationApiController;
// add-use-controller

Route::prefix('/irentcar/v1')->group(function () {
    Route::apiCrud([
        'module' => 'irentcar',
        'prefix' => 'offices',
        'controller' => OfficeApiController::class,
        'permission' => 'irentcar.offices',
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
        'module' => 'irentcar',
        'prefix' => 'gammas',
        'controller' => GammaApiController::class,
        'permission' => 'irentcar.gammas',
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
        'module' => 'irentcar',
        'prefix' => 'extras',
        'controller' => ExtraApiController::class,
        'permission' => 'irentcar.extras',
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
        'module' => 'irentcar',
        'prefix' => 'gamma-office',
        'controller' => GammaOfficeApiController::class,
        'permission' => 'irentcar.gammaoffices',
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
        'module' => 'irentcar',
        'prefix' => 'daily-availabilities',
        'controller' => DailyAvailabilityApiController::class,
        'permission' => 'irentcar.dailyavailabilities',
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
        'module' => 'irentcar',
        'prefix' => 'gamma-office-extra',
        'controller' => GammaOfficeExtraApiController::class,
        'permission' => 'irentcar.gammaofficeextras',
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
        'module' => 'irentcar',
        'prefix' => 'reservations',
        'controller' => ReservationApiController::class,
        'permission' => 'irentcar.reservations',
        //'middleware' => ['create' => [], 'index' => [], 'show' => [], 'update' => [], 'delete' => [], 'restore' => []],
        'customRoutes' => [ // Include custom routes if needed
            [
                'method' => 'get', // get,post,put....
                'path' => '/validation/date', // Route Path
                'uses' => 'validationDate', //Name of the controller method to use
                'middleware' => [] // if not set up middleware, auth:api will be the default
            ],
            [
                'method' => 'get', // get,post,put....
                'path' => '/available/gammas', // Route Path
                'uses' => 'getAvailableGammas', //Name of the controller method to use
                'middleware' => [] // if not set up middleware, auth:api will be the default
            ]
        ]
    ]);
    // append


    /**
     * STATICS CLASS
     */
    Route::apiCrud([
        'module' => 'irentcar',
        'prefix' => 'statuses',
        'staticEntity' => 'Modules\Irentcar\Models\Status',
      'middleware' => ['index' => [], 'show' => []],
    ]);
    Route::apiCrud([
        'module' => 'irentcar',
        'prefix' => 'transmission-types',
        'staticEntity' => 'Modules\Irentcar\Models\TransmissionType',
      'middleware' => ['index' => [], 'show' => []],
    ]);
    Route::apiCrud([
        'module' => 'irentcar',
        'prefix' => 'fuel-types',
        'staticEntity' => 'Modules\Irentcar\Models\FuelType',
      'middleware' => ['index' => [], 'show' => []],
    ]);
    Route::apiCrud([
        'module' => 'irentcar',
        'prefix' => 'vehicle-types',
        'staticEntity' => 'Modules\Irentcar\Models\VehicleType',
      'middleware' => ['index' => [], 'show' => []],
    ]);
    Route::apiCrud([
        'module' => 'irentcar',
        'prefix' => 'reservation-statuses',
        'staticEntity' => 'Modules\Irentcar\Models\ReservationStatus',
        //'middleware' => ['create' => [], 'index' => [], 'show' => [], 'update' => [], 'delete' => [], 'restore' => []]
    ]);
});
