<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $faker = $this->faker;

        $title = $faker->realText(20);
        $slug = Str::slug($title, '-');

        return [
            'user_id' => \mt_rand(1, 10),
            'title' => $title,
            'slug' =>  $slug,
            'image' => $faker->imageUrl(1200, 600, 'animals'),
            'content' => $faker->paragraphs(10, true),
            'isPremium' => \mt_rand(0, 1),
        ];
    }
}
