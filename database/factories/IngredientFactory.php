<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'recipe_id' => $this->faker->numberBetween(1, 10),
            'ingredient' => $this->faker->word(),
            'amount' => $this->faker->numberBetween(50, 500),
            'unit_of_measurement' => $this->faker->word(),
        ];
    }
}
