<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Blogpost;
use App\Models\User;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Category::factory()->create(['name'=>'Fitness & Health']);
        Category::factory()->create(['name'=>'Mental']);
        Category::factory()->create(['name'=>'Language']);
        Category::factory()->create(['name'=>'Culture Study']);
        Category::factory()->create(['name'=>'Educational Opportunities']);
        Category::factory()->create(['name'=>'Entertainment']);

            // $blogpost1=Blogpost::factory()->create(['category_id'=>$frontend->id]);
            // $blogpost2=Blogpost::factory()->create(['category_id'=>$backend->id]);
            // Blogpost::factory(4)->create(['category_id'=>$backend->id]);
            // Comment::factory(3)->create(['user_id'=>$user1->id,'blogpost_id'=>$blogpost1->id]);
            // Comment::factory(3)->create(['user_id'=>$user2->id,'blogpost_id'=>$blogpost1->id]);
            // Comment::factory(3)->create(['user_id'=>$user3->id,'blogpost_id'=>$blogpost2->id]);
           


    }
}
