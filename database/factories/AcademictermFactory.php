<?php

namespace Database\Factories;

use App\Models\Academicterm;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AcademictermFactory extends Factory
{
    protected $model = Academicterm::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'start_date' => $this->faker->name,
			'end_date' => $this->faker->name,
			'status' => $this->faker->name,
        ];
    }
}
