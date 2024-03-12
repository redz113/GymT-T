<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $packages = [
            [
                'package_name' => 'Gói Gym Basic Level 1',
                'subject_id' => 1,
                'avatar' => 'https://goldsgym.in/uploads/blog/compress-strong-man-training-gym-min.jpg',
                'price' => 4500000,
                'price_sale' => 500000/4000000*100,
                'short_description' => "Gói tập dành cho người mới đi tập gym lần đầu",
                'into_price' => 4000000,
                'total_session_pt' => 16,
                'week_session_pt' => 4,
                'description' => 'Tập luyện với Huấn luyện viên cá nhân theo hình thức 1 kèm 1, được thiết kế đặc biệt phù hợp với thể trạng và mục tiêu thể hình riêng của bạn. Thay vì tập một mình, HLV cá nhân sẽ thiết lập những mục tiêu ngắn hạn và dài hạn, lên kế hoạch các bài tập, động viên học viên, cùng thực hiện với họ. HLV sẽ theo dõi quá trình tập luyện, tiếp nhận phản hồi từ học viên và giúp họ vượt qua thử thách.',
                'status' => 1,
                'set_pt' => 1,
                'type_package' => 1,
            ],
            [
                'package_name' => 'Gói Gym GainMass Premium',
                'subject_id' => 1,
                'avatar' => 'https://www.ihrsa.org/uploads/Articles/Column-Width/industry-news_muscular-bicep-dumbbell-stock_column.jpg',
                'price' => 3200000,
                'price_sale' => 200000/3000000*100,
                'short_description' => "Gói tập dành cho người mới quay lại cần PT training",
                'into_price' => 3000000,
                'total_session_pt' => 12,
                'week_session_pt' =>3,
                'description' => 'Tập luyện với Huấn luyện viên cá nhân theo hình thức 1 kèm 1, được thiết kế đặc biệt phù hợp với thể trạng và mục tiêu thể hình riêng của bạn. Thay vì tập một mình, HLV cá nhân sẽ thiết lập những mục tiêu ngắn hạn và dài hạn, lên kế hoạch các bài tập, động viên học viên, cùng thực hiện với họ. HLV sẽ theo dõi quá trình tập luyện, tiếp nhận phản hồi từ học viên và giúp họ vượt qua thử thách.',
                'status' => 1,
                'set_pt' => 1,
                'type_package' => 1,
            ],
            [
                'package_name' => 'Gói Gym Training',
                'subject_id' => 1,
                'avatar' => 'https://media-cldnry.s-nbcnews.com/image/upload/rockcms/2021-12/211208-working-out-stock-mn-1310-55e1c7.jpg',
                'price' => 2000000,
                'price_sale' => 25,
                'short_description' => "Gói tập dành cho người cần PT nhưng không có nhiều thời gian tập",
                'into_price' => 1500000,
                'total_session_pt' => 6,
                'week_session_pt' =>1,
                'description' => 'Tập luyện tại CITIGYM để có cơ hội thay đổi ngoại hình một cách ngoạn mục
                Việc luyện tập đều đặn tại CITIGYM và đúng kỹ thuật, cùng với một chế độ dinh dưỡng hợp lý sẽ giúp cải thiện vóc dáng một cách rõ rệt. Huấn luyện viên của Citigym thiết kế chương trình luyện tập dựa trên chỉ số cơ thể, tình trạng sức khỏe của bạn nhằm giúp bạn thấy rõ sự thay đổi ngoạn mục chỉ trong khoảng trung bình từ 6-8 tuần.',
                
                'status' => 1,
                'set_pt' => 1,
                'type_package' => 1,
            ],
            [
                'package_name' => 'Gói Experience',
                'subject_id' => 1,
                'avatar' => 'https://cdn.muscleandstrength.com/sites/default/files/styles/400x250/public/taxonomy/image/workouts/bicepworkouts.jpg?itok=clgOPXSn',
                'price' => 500000,
                'price_sale' => 100000/400000*100,
                'short_description' => "Gói tập tự do cho thành viên đã có kinh nghiệm tập gym",
                'into_price' => 400000,
                'description' => 'Tập luyện tại CITIGYM để có cơ hội thay đổi ngoại hình một cách ngoạn mục
                Việc luyện tập đều đặn tại CITIGYM và đúng kỹ thuật, cùng với một chế độ dinh dưỡng hợp lý sẽ giúp cải thiện vóc dáng một cách rõ rệt. Huấn luyện viên của Citigym thiết kế chương trình luyện tập dựa trên chỉ số cơ thể, tình trạng sức khỏe của bạn nhằm giúp bạn thấy rõ sự thay đổi ngoạn mục chỉ trong khoảng trung bình từ 6-8 tuần.',
                'status' => 1,
                'set_pt' => 0,
                'type_package' => 2,
            ]
        ];

        foreach($packages as $item){
            Package::create($item);
        }
    }
}
