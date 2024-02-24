<?php

namespace Database\Seeders;

use App\Models\JobApplicationCompany;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobApplicationCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobApplicationCompany::factory()->count(5)->create();
    }
}
