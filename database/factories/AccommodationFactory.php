<?php

namespace Database\Factories;

use App\Models\Accommodation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AccommodationFactory extends Factory
{
    protected $model = Accommodation::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'link' => $this->faker->name,
			'address_id' => $this->faker->name,
        ];
    }
}
