<?php

namespace Database\Factories;

use App\Models\Studentdoc;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentdocFactory extends Factory
{
    protected $model = Studentdoc::class;

    public function definition()
    {
        return [
			'student_id' => $this->faker->name,
			'type_doc' => $this->faker->name,
			'url' => $this->faker->name,
        ];
    }
}
