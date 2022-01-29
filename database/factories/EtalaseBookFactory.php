<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EtalaseBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = 'Etalase' . rand(1, 50);
        return [
            'user_id' => 1,
            'etalase_group_id' => rand(1, 2),
            'name' => $name,
            'slug' => Str::slug($name)
        ];
    }
}
