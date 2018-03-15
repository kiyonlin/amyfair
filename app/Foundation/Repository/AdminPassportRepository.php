<?php

namespace App\Foundation\Repository;

use App;
use Illuminate\Http\Request;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use Laravel\Passport\Bridge\UserRepository;
use Laravel\Passport\Bridge\User;
use RuntimeException;

class AdminPassportRepository extends UserRepository
{
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
        //其实关键的就在这里，就是通过传递一个 guard 参数来告诉它我们是使用 api 还是 admin provider来做认证
        $guard = App::make(Request::class)->get('guard') ?: 'api';
        $provider = config("auth.guards.{$guard}.provider");
        if (is_null($model = config("auth.providers.{$provider}.model"))) {
            throw new RuntimeException('Unable to determine user model from configuration.');
        }

        if (method_exists($model, 'findForPassport')) {
            $user = (new $model)->findForPassport($username);
        } else {
            $user = (new $model)->where('email', $username)->first();
        }

        if (!$user) {
            return;
        } elseif (method_exists($user, 'validateForPassportPasswordGrant')) {
            if (!$user->validateForPassportPasswordGrant($password)) {
                return;
            }
        } elseif (!$this->hasher->check($password, $user->password)) {
            return;
        }

        return new User($user->getAuthIdentifier());
    }
}
