<?php

namespace Database\Factories;

use App\Models\Studentprofile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentprofileFactory extends Factory
{
    protected $model = Studentprofile::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'tel' => $this->faker->name,
			'ic_no' => $this->faker->name,
			'email' => $this->faker->name,
			'gander' => $this->faker->name,
			'funding' => $this->faker->name,
			'student_no' => $this->faker->name,
			'fees' => $this->faker->name,
			'programme_id' => $this->faker->name,
			'academic_term_id' => $this->faker->name,
			'campus_id' => $this->faker->name,
        ];
    }
}
