<?php

namespace Database\Factories;

use App\Models\Administration2;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class Administration2Factory extends Factory
{
    protected $model = Administration2::class;

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
			'passport_no' => $this->faker->name,
			'parent_name' => $this->faker->name,
			'parent_contact_no' => $this->faker->name,
			'parent_address' => $this->faker->name,
			'parent_email' => $this->faker->name,
			'programme_id' => $this->faker->name,
			'institution_id' => $this->faker->name,
			'academic_term_id' => $this->faker->name,
			'campus_id' => $this->faker->name,
			'year' => $this->faker->name,
			'vaccine_type' => $this->faker->name,
			'second_dose' => $this->faker->name,
			'address_iceland' => $this->faker->name,
			'flight_routing' => $this->faker->name,
			'date_arrival' => $this->faker->name,
        ];
    }
}
