<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 管理员可以修改自己的信息.
     *
     * @test
     */
    public function admins_can_update_their_information()
    {
        $this->signInAdmin()->withoutExceptionHandling();
        $admin = auth()->user();

        $this->assertTrue(Hash::check('111111', $admin->password));

        $resp = $this->putJson(route('admin.update', ['admin' => $admin->id]), [
            'password'              => '222222',
            'password_confirmation' => '222222'
        ] + array_only($admin->toArray(), ['name', 'mobile', 'email']))
            ->json();

        $this->assertTrue(Hash::check('222222', $admin->fresh()->password));
    }
}
