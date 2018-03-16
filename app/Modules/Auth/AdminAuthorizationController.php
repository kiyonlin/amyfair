<?php

namespace App\Modules\Auth;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Http\Controllers\ApiController;

class AdminAuthorizationController extends ApiController
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function token()
    {
        $validated = $this->validate(request(), [
            'account'  => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6',
        ], [
        ]);
        $account = request('account');
        $user = Admin::orWhere('email', $account)->orWhere('mobile', $account)->first();

        if ($user && ($user->forbidden == true)) {
            throw new UnauthorizedHttpException('', 'accountForbidden');
        }

        $client = new Client();
        try {
            $request = $client->request('POST', request()->root() . 'oauth/token', [
                'form_params' => config('passport') + $validated + ['guard' => 'admin']
            ]);
        } catch (RequestException $e) {
            throw new UnauthorizedHttpException('', 'Unauthorized');
        }

        if ($request->getStatusCode() == 401) {
            throw  new UnauthorizedHttpException('', 'Unauthorized');
        }

        return $this->respond($request->getBody()->getContents());
    }

    public function logout()
    {
        if (auth('admin')->check()) {
            auth('admin')->user()->token()->revoke();
        }

        return $this->respond('successToLogout');
    }
}
