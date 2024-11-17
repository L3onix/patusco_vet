<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'symptoms' => fake()->text(200),
            'scheduled' => fake()->dateTimeBetween('now', '+1 year'),
            'pet_id' => Pet::factory(),
            'doctor_id' => Doctor::factory(),
        ];
    }
}
