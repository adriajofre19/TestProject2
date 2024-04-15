<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Notes;
use App\Models\Course;
use App\Models\Content;
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

        

        Content::factory(200)->create();



        
    }
}
