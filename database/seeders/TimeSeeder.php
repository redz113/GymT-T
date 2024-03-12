<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = [
            [
                'time_name' => 'Ca 1',
                'start_time' => '5:30:00 am',
                'end_time' => '7:00:00 am',
            ],
            [
                'time_name' => 'Ca 2',
                'start_time' => '7:00:00 am',
                'end_time' => '8:30:00 am',
            ],
            [
                'time_name' => 'Ca 3',
                'start_time' => '5:00:00 pm',
                'end_time' => '6:30:00 pm',
            ],
            [
                'time_name' => 'Ca 4',
                'start_time' => '6:30:00 pm',
                'end_time' => '8:00:00 pm',
            ],
            
        ];

        foreach ($times as $key => $time) {
            Time::create($time);

        }

    }
}
