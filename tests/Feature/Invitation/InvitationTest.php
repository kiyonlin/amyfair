<?php

namespace Tests\Feature\Invitation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Invitation\Invitation;
use Symfony\Component\HttpFoundation\Response;

class InvitationTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * 查看邀请列表.
     *
     * @test
     */
    public function an_admin_can_view_invitation_apply_form()
    {
        $this->signInAdmin();

        create(Invitation::class);

        $resp = $this->getJson(route('admin.invitations.index'))
            ->assertStatus(Response::HTTP_OK)
            ->json();

        $this->assertCount(1, $resp['data']);
    }

    /**
     * 匿名用户可以提交申请.
     *
     * @test
     */
    public function anyone_can_apply_an_invitation_register()
    {
        $invitation = raw(Invitation::class);

        $resp = $this->postJson(route('invitations.store', $invitation))->json();

        $this->assertDatabaseHas('invitations', $invitation);
    }

    /**
     * 管理员可以获取邀请申请详情.
     *
     * @test
     */
    public function an_admin_can_fetch_invitation_details()
    {
        $this->signInAdmin();

        $invitation = create(Invitation::class);

        $resp = $this->getJson(route('admin.invitations.show', ['invitation' => $invitation->id]))
            ->assertStatus(Response::HTTP_OK)
            ->json();

        $this->assertEquals($invitation->toArray(), $resp['data']);
    }

    /**
     * 管理员可以删除邀请申请记录.
     *
     * @test
     */
    public function an_admin_can_destroy_invitation_details()
    {
        $this->signInAdmin();

        $invitation = create(Invitation::class);

        $this->deleteJson(route('admin.invitations.destroy', ['invitation' => $invitation->id]))
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('invitations', ['id' => $invitation->id]);
    }
}
