<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'tel' => $this->faker->name,
			'ic_no' => $this->faker->name,
			'email' => $this->faker->name,
			'gander' => $this->faker->name,
			'current_status' => $this->faker->name,
			'current_institution' => $this->faker->name,
			'get_know_obrien' => $this->faker->name,
			'funding' => $this->faker->name,
			'programme_id' => $this->faker->name,
			'academic_term_id' => $this->faker->name,
			'status' => $this->faker->name,
        ];
    }
}
