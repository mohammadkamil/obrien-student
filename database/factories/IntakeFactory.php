<?php

namespace Database\Factories;

use App\Models\Intake;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class IntakeFactory extends Factory
{
    protected $model = Intake::class;

    public function definition()
    {
        return [
			'student_id' => $this->faker->name,
			'programme_id' => $this->faker->name,
			'academic_term_id' => $this->faker->name,
			'status' => $this->faker->name,
        ];
    }
}
