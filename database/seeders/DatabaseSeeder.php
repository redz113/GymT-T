<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(PackageSeeder::class);
        // $this->call(DiscountSeeder::class);
        $this->call(TimeSeeder::class);
        // $this->call(OrderSeeder::class);
        $this->call(WeekdaySeeder::class);

        $this->call(PostSeeder::class);
        // $this->call(RateSeeder::class);
        // $this->call(ResultContractSeeder::class);    
    }
}
