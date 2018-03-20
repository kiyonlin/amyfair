<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Auth\Admin;
use Laravel\Passport\ClientRepository;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 管理员根据管理员名密码获取token.
     *
     * @test
     */
    public function admin_can_fetch_token_by_username_and_passport()
    {
        // 设置 passport 的client id 和 secret
        $client = app(ClientRepository::class)->createPasswordGrantClient(
            null,
            'amyfair',
            'http://localhost'
        );
        config(['passport.client_id' => $client->id, 'passport.client_secret' => $client->secret]);

        $admin = create(Admin::class);

        $resp = $this->postJson(route('admin.login', [
            'username' => $admin->mobile,
            'password' => '111111'
        ]))
        // ->assertStatus(Response::HTTP_OK)
        ->json();
dd($resp);
        $this->assertArraySubset(
            ['token_type', 'expires_in', 'access_token', 'refresh_token'],
            array_keys($resp)
        );
    }

    /**
     * 禁用管理员无法获取token.
     *
     * @test
     */
    public function forbidden_admin_can_not_fetch_a_token()
    {
        $admin = create(Admin::class, ['forbidden' => true]);

        $resp = $this->postJson(route('admin.login', [
            'username' => $admin->mobile,
            'password' => '111111'
        ]))
        ->assertStatus(Response::HTTP_FORBIDDEN)
        ->json();

        $this->assertEquals('accountForbidden', array_get($resp, 'error.message'));
    }

    /**
     * 认证失败无法获取token.
     *
     * @test
     */
    public function unauthorized_admin_can_not_fetch_a_token()
    {
        $admin = create(Admin::class);

        $resp = $this->postJson(route('admin.login', [
            'username' => $admin->mobile,
            'password' => 'invalid password'
        ]))->assertStatus(Response::HTTP_UNAUTHORIZED)
        ->json();

        $this->assertEquals('unauthorized', array_get($resp, 'error.message'));
    }

    /**
     * 管理员登出.
     *
     * @test
     */
    public function admin_can_logout()
    {
        $this->signInAdmin();

        $resp = $this->getJson(route('admin.logout'))
            // ->assertStatus(200)
            ->json();
dd($resp);
        $this->assertEmpty($resp);
    }

    /** 
     * 获取管理员信息
     * 
     * @test 
     */
    public function admin_can_get_info()
    {
        $this->signInAdmin();

        $resp = $this->getJson(route('admin.info'))
            ->assertStatus(Response::HTTP_CREATED)
            ->json();

        $this->assertEquals($resp['data']['id'], auth()->id());
    }

    /**
     * 登录需要完整的参数.
     *
     * @test
     */
    public function login_admin_requires_valid_params()
    {
        $this->assertErrorsHas($this->login(['mobile' => null]), 'username');
        $this->assertErrorsHas($this->login(['mobile' => str_random(256)]), 'username');
        $this->assertErrorsHas($this->login(['password' => null]), 'password');
        $this->assertErrorsHas($this->login(['password' => '123']), 'password');
    }

    /**
     * 登录辅助函数
     *
     * @param array $override
     * @return array
     */
    protected function login(array $override = [])
    {
        $user = make(User::class, $override);

        return $this->postJson(route('admin.login', [
            'username' => $user->mobile,
            'password' => $user->password
        ]))->json();
    }

    /**
     * 断言辅助，判断验证结果是否包含错误
     *
     * @param array $resp
     * @param string $key
     * @return void
     */
    protected function assertErrorsHas($resp, $key)
    {
        $this->assertArrayHasKey($key, array_get($resp, "errors", []), "{$key} field does not in errors.");
    }
}
