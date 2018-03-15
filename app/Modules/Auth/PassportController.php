<?php

namespace App\Modules\Auth;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Http\Controllers\ApiController;

class PassportController extends ApiController
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * get token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function token()
    {
        $validated = $this->validate(request(), [
            'account'  => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ], [
        ]);
        $account = request('account');
        $user = User::orWhere('email', $account)->orWhere('mobile', $account)->first();

        if ($user && ($user->forbidden == true)) {
            throw new UnauthorizedHttpException('', 'accountForbidden');
        }

        $client = new Client();
        try {
            $request = $client->request('POST', request()->root() . 'oauth/token', [
                'form_params' => config('passport') + $validated
            ]);
        } catch (RequestException $e) {
            throw new UnauthorizedHttpException('', 'Unauthorized');
        }

        if ($request->getStatusCode() == 401) {
            throw  new UnauthorizedHttpException('', 'Unauthorized');
        }

        return response()->json($request->getBody()->getContents());
    }

    /**
     * logout.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (auth('api')->check()) {
            auth('api')->user()->token()->delete();
        }

        return response()->json(['message' => '登出成功', 'status_code' => 200, 'data' => null]);
    }
}
