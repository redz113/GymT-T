<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            [
                'subject_name' => 'Gym',
                'image' => 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/best-luxury-gyms-london-1577449934.jpg',
                'description' => 'Đây là mô tả môn tập Gym',
            ],
            [
                'subject_name' => 'Boxing',
                'image' => 'https://vothuattayson.vn/wp-content/uploads/loi-ich-cua-tap-boxing.jpg',
                'description' => 'Đây là mô tả môn tập Boxing',
            ],
        ];
        foreach($subjects as $item){
            Subject::create($item);
        }
    }
}
