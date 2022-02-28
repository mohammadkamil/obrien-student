<?php

namespace Database\Factories;

use App\Models\Campus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CampusFactory extends Factory
{
    protected $model = Campus::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'address_id' => $this->faker->name,
        ];
    }
}
