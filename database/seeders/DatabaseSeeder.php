<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Quiz::create([
            'name' => 'Perkalian Kembar',
            'topic' => 'matematika',
            'number_of_questions' => 4,
            'time' => 40,
            'required_score_to_pass' => 100,
        ]);
    }
}
