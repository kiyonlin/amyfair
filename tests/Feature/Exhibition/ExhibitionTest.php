<?php

namespace Tests\Feature\Exhibition;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Exhibition\Exhibition;
use Symfony\Component\HttpFoundation\Response;

class ExhibitionTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * 查看展会列表.
     *
     * @test
     */
    public function an_admin_can_view_exhibitions()
    {
        $this->signInAdmin();

        create(Exhibition::class);

        $resp = $this->getJson(route('admin.exhibitions.index'))
            ->assertStatus(Response::HTTP_OK)
            ->json();

        $this->assertCount(1, $resp['data']);
    }

    /**
     * 管理员可以创建展会.
     *
     * @test
     */
    public function an_admin_can_create_exhibitions()
    {
        $this->signInAdmin();

        $exhibition = make(Exhibition::class);

        $resp = $this->postJson(route('admin.exhibitions.store', $exhibition->toArray()))
            ->assertStatus(Response::HTTP_CREATED)
            ->json();

        $this->assertDatabaseHas('exhibitions', $exhibition->toArray());
    }

    /**
     * 管理员可以获取展会详情.
     *
     * @test
     */
    public function an_admin_can_fetch_exhibition_details()
    {
        $this->signInAdmin();

        $exhibition = create(Exhibition::class);

        $resp = $this->getJson(route('admin.exhibitions.show', ['exhibition' => $exhibition->id]))
            ->assertStatus(Response::HTTP_OK)
            ->json();

        $this->assertEquals($exhibition->toArray(), $resp['data']);
    }

    /**
     * 管理员可以更新展会详情.
     *
     * @test
     */
    public function an_admin_can_update_exhibitions()
    {
        $this->signInAdmin();

        $exhibition = create(Exhibition::class);

        $resp = $this->putJson(route('admin.exhibitions.update', ['id' => $exhibition->id]), ['name' => 'new_name'])
            // ->assertStatus(Response::HTTP_OK)
            ->json();

        $this->assertDatabaseHas($exhibition->getTable(), ['id' => $exhibition->id, 'name' => 'new_name']);
    }
}
