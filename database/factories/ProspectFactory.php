<?php

namespace Database\Factories;

use App\Models\Prospect;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProspectFactory extends Factory
{
    protected $model = Prospect::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'tel' => $this->faker->name,
			'parent_name' => $this->faker->name,
			'parent_tel' => $this->faker->name,
			'program' => $this->faker->name,
			'considering Intake' => $this->faker->name,
			'currentstatus' => $this->faker->name,
			'source' => $this->faker->name,
			'notes' => $this->faker->name,
			'status' => $this->faker->name,
        ];
    }
}
