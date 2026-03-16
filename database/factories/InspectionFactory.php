<?php

namespace Database\Factories;

use App\Models\Inspection;
use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

class InspectionFactory extends Factory
{
    protected $model = Inspection::class;

    public function definition(): array
    {
        return [
            'asset_id' => Asset::factory(),
            'inspector_name' => $this->faker->name(),
            'passed' => $this->faker->boolean(80),
            'notes' => $this->faker->sentence(),
        ];
    }
}
