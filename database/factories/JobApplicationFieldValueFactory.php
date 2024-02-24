<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\JobApplication;
use App\Models\JobApplicationField;
use App\Models\JobApplicationFieldValue;

class JobApplicationFieldValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobApplicationFieldValue::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'data' => $this->faker->sentence(4),
            'job_application_field_id' => JobApplicationField::factory(),
            'job_application_id' => JobApplication::factory(),
        ];
    }
}
