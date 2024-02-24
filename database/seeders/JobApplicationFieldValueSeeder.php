<?php

namespace Database\Seeders;

use App\Models\JobApplicationFieldValue;
use Illuminate\Database\Seeder;

class JobApplicationFieldValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobApplicationFieldValue::factory()->count(5)->create();
    }
}
