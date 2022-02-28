<?php

namespace Database\Factories;

use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LecturerFactory extends Factory
{
    protected $model = Lecturer::class;

    public function definition()
    {
        return [
			'institution_id' => $this->faker->name,
			'programme_id' => $this->faker->name,
			'subject_id' => $this->faker->name,
			'name' => $this->faker->name,
			'email' => $this->faker->name,
        ];
    }
}
