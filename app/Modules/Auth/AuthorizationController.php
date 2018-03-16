<?php

namespace App\Modules\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class AuthorizationController extends ApiController
{
    /**
     * get token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function token(Request $request)
    {
        $validated = $this->validate(request(), [
            'username'  => 'required|max:255',
            'password'  => 'required|min:6',
        ], [
            'username.required' => 'usernameRequired',
            'username.max'      => 'usernameMoreThan255',
            'password.required' => 'passwordRequired',
            'password.min'      => 'passwordLessThan6',
        ]);

        $username = request('username');
        $user = User::orWhere('email', $username)->orWhere('mobile', $username)->first();

        if ($user && ($user->forbidden == true)) {
            return $this->respondForbidden('accountForbidden');
        }

        $request->request->add(config('passport') + $validated);

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        $response = \Route::dispatch($proxy);

        if ($response->getStatusCode() == 401) {
            return $this->respondUnauthorized();
        }

        return $this->respond(json_decode($response->getContent(), true));
    }

    /**
     * logout.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (auth('api')->check()) {
            optional(auth('api')->user()->token())->revoke();
        }

        return $this->respond(['message' => 'logout']);
    }

    /**
     * get user info.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfo()
    {
        return new UserResource((auth()->user()));
    }
}
