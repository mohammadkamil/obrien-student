<?php

namespace Database\Factories;

use App\Models\Administration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdministrationFactory extends Factory
{
    protected $model = Administration::class;

    public function definition()
    {
        return [
			'student_id' => $this->faker->name,
			'vaccine_type' => $this->faker->name,
			'second_dose' => $this->faker->name,
			'address_id' => $this->faker->name,
			'flight_routing' => $this->faker->name,
			'date_arrival' => $this->faker->name,
        ];
    }
}
