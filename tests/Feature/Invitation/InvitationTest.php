<?php

namespace Tests\Feature\Invitation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Invitation\Invitation;

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
        create(Invitation::class);

        $resp = $this->getJson(route('admin.invitations.index'))->json();

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
}
