<?php

namespace Database\Seeders;

use App\Models\JobApplicationRole;
use Illuminate\Database\Seeder;

class JobApplicationRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobApplicationRole::factory()->count(5)->create();
    }
}
