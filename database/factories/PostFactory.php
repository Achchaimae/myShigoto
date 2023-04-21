<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //id	image	title	description	tag	city	type_of_post
            'image' => $this->faker->imageUrl(640, 480, 'company', true, 'Faker'),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph(1),
            'tag' => $this->faker->word,
            'city' => $this->faker->city,
            'type_of_post' => $this->faker->randomElement(['CDI', 'STAGE', 'CDD', 'INTERIM', 'ALTERNANCE', ]),
        ];
    }
}
