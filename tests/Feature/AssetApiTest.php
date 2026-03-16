<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Asset;
use App\Models\Inspection;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssetApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Charles',
            'email' => 'charles@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'email' => 'charles@test.com'
        ]);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }

    public function test_asset_can_be_created()
    {
        $response = $this->postJson('/api/assets', [
            'name' => 'Generator A',
            'serial_number' => 'GEN-001',
            'status' => 'active'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('assets', [
            'serial_number' => 'GEN-001'
        ]);
    }

    public function test_assets_can_be_listed()
    {
        Asset::factory()->count(3)->create();

        $response = $this->getJson('/api/assets');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_asset_can_be_fetched_with_latest_three_inspections()
    {
        $asset = Asset::factory()->create();

        Inspection::factory()->count(5)->create([
            'asset_id' => $asset->id
        ]);

        $response = $this->getJson("/api/assets/{$asset->id}");

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data.inspections');
    }

    public function test_inspection_can_be_created()
    {
        $asset = Asset::factory()->create();

        $response = $this->postJson("/api/assets/{$asset->id}/inspections", [
            'inspector_name' => 'Mike',
            'passed' => true,
            'notes' => 'Routine check'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('inspections', [
            'asset_id' => $asset->id,
            'inspector_name' => 'Mike'
        ]);
    }

    public function test_sanctum_protected_routes_require_authentication()
    {
        $response = $this->getJson('/api/v1/assets');

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_access_sanctum_routes()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/v1/assets');

        $response->assertStatus(200);
    }
}
