<?php

namespace Database\Seeders;

use App\Models\Weekday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeekdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weekdays = [
            [
                'weekday_name' => 'Monday',

            ],
            [
                'weekday_name' => 'Tuesday',

            ],
            [
                'weekday_name' => 'Wednesday',

            ],
            [
                'weekday_name' => 'Thursday',

            ],
            [
                'weekday_name' => 'Friday',

            ],
            [
                'weekday_name' => 'Saturday',

            ],
            [
                'weekday_name' => 'Sunday',

            ],

            
        ];

        foreach ($weekdays as $key => $time) {
            Weekday::create($time);

        }
    }
}
