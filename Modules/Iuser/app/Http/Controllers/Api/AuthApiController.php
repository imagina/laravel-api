<?php

namespace Modules\Iuser\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Imagina\Icore\Http\Controllers\CoreApiController;

use Modules\Iuser\Models\User;
use Modules\Iuser\Repositories\UserRepository;
use Modules\Iuser\Services\AuthService;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;


class AuthApiController extends CoreApiController
{

    protected $authService;

    public function __construct(User $model, UserRepository $modelRepository, AuthService $authService)
    {
        parent::__construct($model, $modelRepository);
        $this->authService = $authService;
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        try {

            //Validate request
            $data = $request->input('attributes') ?? [];
            $this->validateWithModelRules($data, 'login');

            //Get user by email
            $params = json_decode(json_encode(["filter" => ["field" => "email"]]));
            $user = $this->modelRepository->getItem($data['email'], $params);

            //Validate user and password
            if (!$user || !Hash::check($data['password'], $user->password)) {
                throw new \Exception('Unauthorized', 401);
            }

            //Create Passport token
            $tokenResult = $user->createToken('authToken');

            $response = ['data' => [
                'user' => $user,
                'token' => $tokenResult,
                //'userToken' => $tokenResult->accessToken,
                //'expiresDate' => $tokenResult->token->expires_at
            ]];
        } catch (\Exception $e) {
            $status = $this->getHttpStatusCode($e);
            $response = $this->getErrorResponse($e);
        }

        //Return response
        return response()->json($response ?? ['data' => 'Request successful'], $status ?? 200);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        try {

            $user = Auth::user();
            $user->token()->revoke(); //Revoke the token

            $response = ['data' => 'Logout successful'];
        } catch (\Exception $e) {
            $status = $this->getHttpStatusCode($e);
            $response = $this->getErrorResponse($e);
        }

        //Return response
        return response()->json($response ?? ['data' => 'Request successful'], $status ?? 200);
    }

    /**
     * Reset Password
     */
    public function reset(Request $request)
    {
        try {

            //Validate request
            $data = $request->input('attributes') ?? [];
            $this->validateWithModelRules($data, 'resetPassword');

            //Process reset password
            $result = Password::sendResetLink(['email' => $data['email']]);

            //TODO: Traducciones
            if ($result === Password::ResetLinkSent) {
                //status = passwords.sent
                $message = "We have emailed your password reset link";
            } else {
                //status = passwords.throttled
                $message = "Please wait before retrying";
            }

            $response = ['data' => $message];
        } catch (\Exception $e) {
            $status = $this->getHttpStatusCode($e);
            $response = $this->getErrorResponse($e);
        }

        //Return response
        return response()->json($response ?? ['data' => 'Request successful'], $status ?? 200);
    }

    /**
     * Reset Password Complete
     */
    public function resetComplete(Request $request)
    {
        try {

            //Validate request
            $data = $request->input('attributes') ?? [];
            $this->validateWithModelRules($data, 'resetPasswordComplete');

            //Process reset password complete
            $result = Password::reset(
                $data,
                function ($model, string $password) {
                    $model->forceFill([
                        'password' => $password
                    ])->setRememberToken(\Str::random(60));

                    $model->save();
                }
            );

            //TODO: Traducciones
            if ($result === Password::PasswordReset) {
                //status = passwords.reset
                $message = "Password reset successfully.";
            } else {
                //status = passwords.token
                $message = "Invalid information";
            }

            $response = ['data' => $message];
        } catch (\Exception $e) {
            $status = $this->getHttpStatusCode($e);
            $response = $this->getErrorResponse($e);
        }

        //Return response
        return response()->json($response ?? ['data' => 'Request successful'], $status ?? 200);
    }
}
