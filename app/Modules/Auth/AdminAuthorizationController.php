<?php

namespace App\Modules\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class AdminAuthorizationController extends ApiController
{
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
        $admin = Admin::orWhere('email', $username)->orWhere('mobile', $username)->first();

        if ($admin && ($admin->forbidden == true)) {
            return $this->respondForbidden('accountForbidden');
        }

        $request->request->add(config('passport') + $validated + ['guard' => 'admin']);

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

    public function logout()
    {
        if (auth('admin')->check()) {
            auth('admin')->user()->token()->revoke();
        }

        return $this->respond('successToLogout');
    }

    /**
     * get admin info.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminInfo()
    {
        return new UserResource(auth('admin')->user());
    }
}
