<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Blogpost;
use App\Models\Category;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blogpost>
 */
class BlogpostFactory extends Factory
{
   /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'category_id'=>Category::factory(),
            'user_id'=>User::factory(),
            'blogtitle'=>$this->faker->sentence(),
            'filename'=>$this->faker->slug(),
            'intro'=>$this->faker->sentence(),
            'blogbody'=>$this->faker->paragraph()

        ];
    }
}