<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;

class AuthenticateApi extends Authenticate
{
    protected function authenticate(array $guards)
    {
        if ($this->auth->guard('api')->check()) {
            return $this->auth->shouldUse('api');
        }

        return response('unauthenticated', 401);
    }
}
