<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'discount_id' => rand(1,10),
            'package_id' => rand(1,10),
            'date_start' => '2022-10-15',
            'date_end' => '2022-12-15',
            'pt_id' => rand(3,5),
            'total_money' => 2000000,
            'payment_method' => rand(1,2),
            'status'=> 0,
        ];
    }
}
