<?php

namespace Database\Seeders;

use App\Models\JobApplicationField;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobApplicationFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobApplicationField::factory()->count(5)->create([
            'user_id' => User::first()->id
        ]);
    }
}
