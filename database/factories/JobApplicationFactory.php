<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\JobApplication;
use App\Models\JobApplicationCompany;
use App\Models\JobApplicationRole;
use App\Models\User;

class JobApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobApplication::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'link' => $this->faker->url(),
            'date_applied' => $this->faker->dateTime(),
            'salary_annual_min' => $this->faker->numberBetween(60000, 80000),
            'salary_annual_max' => $this->faker->numberBetween(100000, 120000),
            'salary_currency' => $this->faker->currencyCode(),
            'job_application_company_id' => JobApplicationCompany::factory(),
            'job_application_role_id' => JobApplicationRole::factory(),
            'user_id' => User::factory(),
        ];
    }
}
