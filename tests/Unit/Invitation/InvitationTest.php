<?php

namespace Tests\Unit\Invitation;

use Tests\TestCase;
use App\Modules\Invitation\Invitation;
use App\Modules\Exhibition\Exhibition;

class InvitationTest extends TestCase
{
    /**
     * 邀请属于一个展会.
     *
     * @test
     */
    public function it_belongs_to_an_exhibition()
    {
        $invitation = create(Invitation::class);

        $this->assertInstanceOf(Exhibition::class, $invitation->exhibition);
    }
}
