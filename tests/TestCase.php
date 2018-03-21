<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Modules\Auth\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * 模拟登陆用户.
     *
     * @param null $user
     *
     * @return $this
     */
    protected function signInMember($user = null)
    {
        $user = $user ?: create(User::class);

        $this->actingAs($user, 'api');

        return $this;
    }

    /**
     * 模拟登陆管理员.
     *
     * @param null $admin
     *
     * @return $this
     */
    protected function signInAdmin($admin = null)
    {
        $admin = $admin ?: create(User::class, ['admin' => true]);

        $this->actingAs($admin, 'api');

        return $this;
    }
}
