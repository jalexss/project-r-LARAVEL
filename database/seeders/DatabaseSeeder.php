<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Receta;
use App\Models\Profile;
use App\Models\Ingredient;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Profile::factory(10)->create();
        Receta::factory(20)->create();
        Ingredient::factory(10)->create();
        Comment::factory(10)->create();

        User::factory()->create([
            'username' => 'alex',
            'email' => 'alex@prueba.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password 
        ]);
    }
}
