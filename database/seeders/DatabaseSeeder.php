<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
             'name' => 'Bryan Gruneberg',
             'email' => 'bryan@bryan.bg',
             'password' => Hash::make('asdasdasd'),
         ]);
        
         $this->call([
            JobApplicationCompanySeeder::class,
            JobApplicationFieldSeeder::class,
            JobApplicationFieldValueSeeder::class,
            JobApplicationSeeder::class,
        ]);
    }
}
