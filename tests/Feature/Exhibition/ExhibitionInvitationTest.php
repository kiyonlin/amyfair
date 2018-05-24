<?php

namespace Tests\Feature\Exhibition;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Exhibition\Exhibition;
use Symfony\Component\HttpFoundation\Response;

class ExhibitionInvitationTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * 查看展会邀请列表.
     *
     * @test
     */
    public function get_invitation_exhibitions()
    {
        create(Exhibition::class, ['start_at' => now()->addMonth()], 5);
        create(Exhibition::class, ['start_at' => now()->subMonth()], 5);

        $resp = $this->getJson(route('exhibitions.invitations.index'))
            ->assertStatus(Response::HTTP_OK)
            ->json();

        $this->assertCount(5, $resp['data']);
    }
}
