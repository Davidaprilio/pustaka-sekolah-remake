<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PivotEtalaseBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'book_id' => rand(1, 20),
            'etalase_book_id' => rand(1, 6),
        ];
    }
}
