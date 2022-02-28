<?php

namespace Database\Factories;

use App\Models\Officialdoc;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OfficialdocFactory extends Factory
{
    protected $model = Officialdoc::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'url' => $this->faker->name,
        ];
    }
}
