<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Modules\Inotification\Services\NotificationDispatcherService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


$router->group(['prefix' => '/inotification/v1'], function (Router $router) {

    //Show Render Example Email
    if (app()->environment('local')) {
        Route::get('/preview-email', function (Request $request) {
            $to = $request->query('email');

            $data = [
                'title' => itrans("inotification::notification.email.default.title"),
                'message' => itrans("inotification::notification.email.default.message")
            ];

            if ($to) {
                //Validation Email
                if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                    return response()->json(['error' => 'Invalid Email'], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                app(NotificationDispatcherService::class)->execute(['email' => $to]);
            }

            return view('inotification::emails.contents.default', compact('data'));
        });
    }
});
