<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(3,10),
            'package_id' => rand(1,10),
            'activate_date' => '2022-10-15',
            'order_id' => rand(1,10),
            'start_date' => '2022-10-15',
            'end_start' => '2022-12-15',
            
        ];
    }
}
