<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Asset;
use App\Models\Inspection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssetApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_asset_can_be_created()
    {
        $response = $this->postJson('/api/public/assets', [
            'name' => 'Generator A',
            'serial_number' => 'GEN-001',
            'status' => 'active'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('assets', [
            'serial_number' => 'GEN-001'
        ]);
    }

    public function test_asset_can_be_fetched_with_latest_three_inspections()
    {
        $asset = Asset::factory()->create();

        Inspection::factory()->count(5)->create([
            'asset_id' => $asset->id
        ]);

        $response = $this->getJson("/api/public/assets/{$asset->id}");

        $response->assertStatus(200);

        $response->assertJsonCount(3, 'data.inspections');
    }
}
