<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Auth\User;
use Laravel\Passport\ClientRepository;
use Symfony\Component\HttpFoundation\Response;

class MemberAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 用户根据用户名密码获取token.
     *
     * @test
     */
    public function user_can_fetch_token_by_username_and_passport()
    {
        // 设置 passport 的client id 和 secret
        $client = app(ClientRepository::class)->createPasswordGrantClient(
            null,
            'amyfair',
            'http://localhost'
        );
        config(['passport.client_id' => $client->id, 'passport.client_secret' => $client->secret]);

        $user = create(User::class);

        $resp = $this->postJson(route('login', [
            'username' => $user->mobile,
            'password' => '111111'
        ]))->assertStatus(Response::HTTP_OK)
        ->json();

        $this->assertArraySubset(
            ['token_type', 'expires_in', 'access_token', 'refresh_token'],
            array_keys($resp)
        );
    }

    /**
     * 禁用用户无法获取token.
     *
     * @test
     */
    public function forbidden_user_can_not_fetch_a_token()
    {
        $user = create(User::class, ['forbidden' => true]);

        $resp = $this->postJson(route('login', [
            'username' => $user->mobile,
            'password' => '111111'
        ]))->assertStatus(Response::HTTP_FORBIDDEN)
        ->json();

        $this->assertEquals('accountForbidden', array_get($resp, 'error.message'));
    }

    /**
     * 认证失败无法获取token.
     *
     * @test
     */
    public function unauthorized_user_can_not_fetch_a_token()
    {
        $user = create(User::class);

        $resp = $this->postJson(route('login', [
            'username' => $user->mobile,
            'password' => 'invalid password'
        ]))->assertStatus(Response::HTTP_UNAUTHORIZED)
        ->json();

        $this->assertEquals('unauthorized', array_get($resp, 'error.message'));
    }

    /**
     * 用户登出.
     *
     * @test
     */
    public function user_can_logout()
    {
        $this->signInMember();

        $resp = $this->getJson(route('logout'))
            ->assertStatus(200)
            ->json();

        $this->assertEmpty($resp);
    }

    /** 
     * 获取用户信息
     * 
     * @test 
     */
    public function user_can_get_info()
    {
        $this->signInMember();

        $resp = $this->getJson(route('user.info'))
            ->assertStatus(Response::HTTP_CREATED)
            ->json();

        $this->assertEquals($resp['data']['id'], auth()->id());
    }

    /**
     * 登录需要完整的参数.
     *
     * @test
     */
    public function login_requires_valid_params()
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

        return $this->postJson(route('login', [
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
