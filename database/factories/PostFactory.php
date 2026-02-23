<?php

namespace Database\Factories;

use App\Models\Category;
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
        $titleEn = fake()->sentence();

        return [
            'title' => [
                'en' => $titleEn,
                'pt' => fake('pt_PT')->sentence(),
            ],
            'content' => [
                'en' => fake()->paragraphs(3, true),
                'pt' => fake('pt_PT')->paragraphs(3, true),
            ],
            'category_id' => Category::factory(),
            'image_url' => 'https://picsum.photos/seed/' . fake()->uuid() . '/800/450',
        ];
    }
}