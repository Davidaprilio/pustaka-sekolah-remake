<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        $cover = 'assets/media/books/' . rand(1, 13) . '.png';
        return [
            'user_id' => 1,
            'title' => $title,
            'cover' => $cover,
            'path' => $cover,
            'files' => '[]',
            'pages' => rand(3, 400),
            'slug' => Str::slug($title),
            'author' => $this->faker->name(),
            'writer' => $this->faker->name(),
            'publisher' => $this->faker->company(),
            // 'etalase' => rand(1, 2),
            'download' => rand(1, 200),
            'read' => rand(1, 200),
            'num_book' => rand(1000, 9000),
            'description' => $this->faker->paragraphs(2, true),
        ];
    }
}
