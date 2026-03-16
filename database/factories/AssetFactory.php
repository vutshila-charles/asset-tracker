<?php

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    protected $model = Asset::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'serial_number' => strtoupper($this->faker->bothify('SN-#####')),
            'status' => $this->faker->randomElement([
                'active',
                'maintenance',
                'retired'
            ]),
        ];
    }
}
