<?php

namespace Database\Factories;

use App\Models\Programme;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProgrammeFactory extends Factory
{
    protected $model = Programme::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'code' => $this->faker->name,
        ];
    }
}
