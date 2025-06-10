<?php

namespace Modules\Iuser\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthCan
{

    public function handle(Request $request, Closure $next, $permission = null)
    {

        //Check if the user is authenticated
        $user = Auth::guard('api')->user()?->load('roles');

        if (!$user) {
            return response()->json(
                [
                    'message' => Response::$statusTexts[Response::HTTP_UNAUTHORIZED],
                    'errorCode' => Response::HTTP_UNAUTHORIZED
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        //If a permission was passed,
        if ($permission) {
            if (!$user->hasPermission($permission)) {
                return response()->json(
                    [
                        'message' => Response::$statusTexts[Response::HTTP_FORBIDDEN],
                        'errorCode' => Response::HTTP_FORBIDDEN
                    ],
                    Response::HTTP_FORBIDDEN
                );
            }
        }

        return $next($request);
    }
}
