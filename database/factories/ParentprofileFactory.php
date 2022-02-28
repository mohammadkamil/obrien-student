<?php

namespace Database\Factories;

use App\Models\Parentprofile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ParentprofileFactory extends Factory
{
    protected $model = Parentprofile::class;

    public function definition()
    {
        return [
			'student_id' => $this->faker->name,
			'name' => $this->faker->name,
			'contact_no' => $this->faker->name,
			'address_id' => $this->faker->name,
			'email' => $this->faker->name,
        ];
    }
}
