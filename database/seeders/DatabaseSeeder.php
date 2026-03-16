<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asset;
use App\Models\Inspection;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password')
            ]
        );

        Asset::factory()
            ->count(10)
            ->create()
            ->each(function ($asset) {

                Inspection::factory()
                    ->count(rand(1,5))
                    ->create([
                        'asset_id' => $asset->id
                    ]);

            });
    }
}