<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'discount_title' => fake()->name(),
            'discount_code' => Str::random(10),
            'price_sale' => rand(10,20),
            'quantity' => rand(1,10),
            'package_id' => rand(1,5) .'|'. rand(6,10),
            'start_date' => '2022-10-15',
            'end_date' => '2022-12-15',
            
            'status' => 1,

        ];
    }
}
