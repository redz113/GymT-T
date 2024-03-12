<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'package_name' => 'Gói New',
                'subject_id' => 1,
                'avatar' => 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/best-luxury-gyms-london-1577449934.jpg',
                'price' => 20000,
                'price_sale' => 0,
                'short_description' => "Gói tập này dành cho người mới tham gia tập",
                'into_price' => 20000,
                'description' => 'Đây là mô tả gói tập',
                'status' => rand(0, 1),
                'set_pt' => rand(0, 1),
                'type_package' => 1,
        ];
    }
}
