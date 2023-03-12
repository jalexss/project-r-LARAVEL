<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Receta;
use App\Models\Profile;
use App\Models\Ingredient;
use App\Models\Comment;

class RecetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::factory()
            ->count(5)
            ->has(
                Receta::factory()
                    ->count(20)
                    ->hasIngredients(5)
                    ->hasComments(5)
                    // ->create()
            )
            ->create();
        
        // $user1 = User::factory()->create();
        // $profile1 = Profile::factory()
        //     ->count(1)
        //     ->for($user1)
        //     ->create();

        // $recetas = Receta::factory()
        //     ->count(20)
        //     ->for($profile1)
        //     ->create();

        // $ingredients = Ingredient::factory()
        //     ->count(5)
        //     ->for($receta)
        //     ->create();

        // $comments = Comment::factory()
        //     ->count(5)
        //     ->for($receta)
        //     -create();
    }
}
