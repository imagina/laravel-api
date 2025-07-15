<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Modules\Inotification\Services\NotificationService;
use Illuminate\Http\Request;



$router->group(['prefix' => '/inotification/v1'], function (Router $router) {

    //Show Render Example Email
    if (app()->environment('local')) {
        Route::get('/preview-email', function (Request $request) {

            $data = app(NotificationService::class)->getDataExample($request);

            return view('inotification::emails.contents.default', compact('data'));
        });
    }
});
