<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid'  => $this->faker->uuid(),
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(6, true),
            'slug'  => $this->faker->slug(6, true),
            'body'  => $this->faker->sentences(100, true),
            'image' => '2560x1440.png',
            'published_at' => Carbon::now(),
        ];
    }
}
