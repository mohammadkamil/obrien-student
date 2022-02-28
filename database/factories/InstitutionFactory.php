<?php

namespace Database\Factories;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InstitutionFactory extends Factory
{
    protected $model = Institution::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'link' => $this->faker->name,
			'address_id' => $this->faker->name,
        ];
    }
}
