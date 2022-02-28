<?php

namespace Database\Factories;

use App\Models\Alumni;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AlumniFactory extends Factory
{
    protected $model = Alumni::class;

    public function definition()
    {
        return [
			'student_id' => $this->faker->name,
			'graduate_year' => $this->faker->name,
			'status' => $this->faker->name,
        ];
    }
}
