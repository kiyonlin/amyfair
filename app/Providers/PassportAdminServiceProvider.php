<?php

namespace App\Providers;

use Laravel\Passport\PassportServiceProvider;
use Laravel\Passport\Passport;
use \League\OAuth2\Server\Grant\PasswordGrant;

class PassportAdminServiceProvider extends PassportServiceProvider
{
    /**
     * Create and configure a Password grant instance.
     *
     * @return \League\OAuth2\Server\Grant\PasswordGrant
     */
    protected function makePasswordGrant()
    {
        $grant = new PasswordGrant(
            $this->app->make(\App\Foundation\Repository\AdminPassportRepository::class),
            $this->app->make(\Laravel\Passport\Bridge\RefreshTokenRepository::class)
        );

        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());

        return $grant;
    }
}
