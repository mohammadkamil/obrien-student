<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
			'student_profile_id' => $this->faker->name,
			'programme_id' => $this->faker->name,
			'institution_id' => $this->faker->name,
			'academic_term_id' => $this->faker->name,
			'campus_id' => $this->faker->name,
        ];
    }
}
