<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition()
    {
        return [
			'address1' => $this->faker->name,
			'address2' => $this->faker->name,
			'address3' => $this->faker->name,
			'city' => $this->faker->name,
			'state' => $this->faker->name,
			'country' => $this->faker->name,
			'postcode' => $this->faker->name,
        ];
    }
}
