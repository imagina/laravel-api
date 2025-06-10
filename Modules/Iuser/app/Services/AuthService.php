<?php

namespace Modules\Iuser\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthService
{

    /**
     * GET TOKEN | REFRESH | PASSPORT
     */
    public function getToken($type = "password", $data)
    {

        $endpoint = env('APP_URL') . '/oauth/token';

        //Base Attributes
        $attributes = [
            'grant_type' => $type,
            'client_id' => $data['clientId'] ?? env('PASSPORT_PASSWORD_CLIENT_ID'),
            'client_secret' => $data['clientSecret'] ?? env('PASSPORT_PASSWORD_CLIENT_SECRET'),
            'scope' => $data['scope'] ?? ''
        ];

        //Validation By Type
        if ($type == "password") {
            $attributes['username'] = $data['email'];
            $attributes['password'] = $data['password'];
        }

        if ($type == "refresh_token") {
            $attributes['refresh_token'] = $data['token'];
        }

        //Get
        $responseToken = Http::asForm()->post($endpoint, $attributes);

        //Format Response
        $tokenData = json_decode((string) $responseToken->getBody(), true);

        return $tokenData;
    }

    /**
     *
     */
    public function logUserIn($user)
    {
        Auth::login($user); //OJO: esto nose si sea necesario
        session()->regenerate();
    }

    /**
     *
     */
    public function logUserOut()
    {
        //Method Laravel\Passport\Guards\TokenGuard::logout does not exist.
        //Auth::logout();

        session()->invalidate();
        session()->regenerateToken();
    }
}
