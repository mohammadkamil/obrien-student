<?php

namespace Database\Factories;

use App\Models\Surveyanswered;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SurveyansweredFactory extends Factory
{
    protected $model = Surveyanswered::class;

    public function definition()
    {
        return [
			'alumnis_id' => $this->faker->name,
			'subject_id' => $this->faker->name,
			'answer' => $this->faker->name,
			'a1' => $this->faker->name,
			'a2' => $this->faker->name,
			'a3' => $this->faker->name,
			'a4' => $this->faker->name,
			'b1' => $this->faker->name,
			'b2' => $this->faker->name,
			'b3' => $this->faker->name,
			'c1' => $this->faker->name,
			'c2' => $this->faker->name,
			'c3' => $this->faker->name,
			'c4' => $this->faker->name,
			'd1' => $this->faker->name,
			'd2' => $this->faker->name,
			'd3' => $this->faker->name,
			'e1' => $this->faker->name,
			'e2' => $this->faker->name,
			'e3' => $this->faker->name,
        ];
    }
}
