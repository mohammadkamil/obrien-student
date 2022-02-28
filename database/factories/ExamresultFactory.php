<?php

namespace Database\Factories;

use App\Models\Examresult;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExamresultFactory extends Factory
{
    protected $model = Examresult::class;

    public function definition()
    {
        return [
			'student_id' => $this->faker->name,
			'academic_term_id' => $this->faker->name,
			'subject_id' => $this->faker->name,
			'mark' => $this->faker->name,
        ];
    }
}
