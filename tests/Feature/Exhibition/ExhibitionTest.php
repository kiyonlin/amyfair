<?php

namespace Tests\Feature\Exhibition;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Exhibition\Exhibition;

class ExhibitionTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic test example.
     */
    public function testExample()
    {
        $exhibition = create(Exhibition::class);
        dd($exhibition->toArray());
    }
}
