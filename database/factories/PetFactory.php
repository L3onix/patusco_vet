<?php

namespace Database\Factories;

use App\Enums\PetAnimalTypes;
use App\Models\Tutor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'age' => fake()->numberBetween(0, 20),
            'animal_type' => fake()->randomElement(PetAnimalTypes::cases())->value,
            'tutor_id' => Tutor::factory(),
        ];
    }
}
