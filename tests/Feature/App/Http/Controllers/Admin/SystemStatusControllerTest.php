<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\Status;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class SystemStatusControllerTest
 * @package Tests\Feature
 */
class SystemStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_can_see_all_system_statuses()
    {
        $user = User::factory()->create();
        $statuses = Status::factory(4)->create();

        $response = $this->actingAs($user)->get(route("admin.statuses"));

        $response->assertStatus(200);
        $response->assertViewIs("admin.statuses.index");
        $statuses->each(function ($status) use ($response) {
            $response->assertSee($status->id);
        });
    }

    public function test_we_can_see_the_create_system_status_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("admin.statuses.create"));

        $response->assertStatus(200);
        $response->assertViewIs("admin.statuses.create");
    }

    public function test_we_can_see_the_store_a_system_status()
    {
        $user = User::factory()->create();
        $data = [
            'type' => 'High',
            'post' => 'test'
        ];

        $response = $this->actingAs($user)->post(route("admin.statuses.store"), $data);

        $response->assertRedirect(route('admin.statuses'));
        $this->assertDatabaseHas('statuses', [
            'type' => $data['type'],
            'post' => $data['post'],
        ]);
    }

    public function test_we_can_see_the_edit_status_page()
    {
        $user = User::factory()->create();
        $status = Status::factory()->create(['type' => 'Low', 'post' => 'post']);

        $response = $this->actingAs($user)->get(route("admin.statuses.edit", $status));

        $response->assertStatus(200);
        $response->assertViewIs("admin.statuses.edit");
        $response->assertSee($status->post);
        $response->assertSee($status->type);
    }

    public function test_we_cannnot_see_the_edit_status_page_for_a_status_that_does_not_exist()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("admin.statuses.edit", 'does-not-exist'));

        $response->assertStatus(404);
    }

    public function test_we_can_update_a_status()
    {
        $user = User::factory()->create();
        $status = Status::factory()->create(['type' => 'Low', 'post' => 'post']);
        $data = [
            'type' => 'High',
            'post' => 'updated post'
        ];

        $response = $this->actingAs($user)->post(route("admin.statuses.update", $status), $data);

        $response->assertRedirect(route('admin.statuses.edit', $status));
        $this->assertDatabaseHas('statuses', [
            'id' => $status->id,
            'type' => $data['type'],
            'post' => $data['post'],
        ]);
    }

    public function test_we_cannot_update_a_status_that_does_not_exist()
    {
        $user = User::factory()->create();
        $data = [
            'type' => 'High',
            'post' => 'updated post'
        ];

        $response = $this->actingAs($user)->post(route("admin.statuses.update", 'does-not-exist'), $data);

        $response->assertStatus(404);
    }

    public function test_we_can_delete_a_status()
    {
        $user = User::factory()->create();
        $status = Status::factory()->create();

        $response = $this->actingAs($user)->get(route("admin.statuses.delete", $status));

        $response->assertRedirect(route('admin.statuses'));
        $this->assertDatabaseMissing('statuses', [
            'id' => $status->id,
        ]);
    }

    public function test_we_cannot_delete_a_status_that_does_not_exist()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("admin.statuses.delete", 'does-not-exist'));

        $response->assertStatus(404);
    }


    public function test_we_cannot_see_account_system_statuses_page_if_we_are_not_authenticated()
    {
        $this->get(route("admin.statuses"))->assertRedirect(route('login'));
    }
}