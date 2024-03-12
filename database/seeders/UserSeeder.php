<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nameRole = [
            'admin',
            'coach',
            'manager',
            'member',
            // 'coachbx'
            
        ];

        foreach ($nameRole as  $value) {
            Role::create(['name' => $value]);
        }

        $users = [
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'admin@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999), 
                'avatar' => fake()->imageUrl(),
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Nguyễn Huy Hoàng',
                'email' => 'manager@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => fake()->imageUrl(),
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Nguyễn Văn Quân',
                'email' => 'coach@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => 'https://i.ex-cdn.com/nhadautu.vn/files/content/2020/08/07/386530108316255472264451872500067146680079n-1536476550357380511152-1032.jpg',
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Nguyễn Mạnh Quân',
                'email' => 'member@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => fake()->imageUrl(),
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Nguyễn Tiến Hoàng',
                'email' => 'coach2@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => 'https://realfitness.com.my/wp-content/uploads/2022/03/1-c.jpg',
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Nguyễn Quang Huy',
                'email' => 'coach3@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => 'https://file.hstatic.net/1000008082/file/4473799821095317193764876592516233738846208o-1586613383237162104757_db11ddcffabd4deead86d27b530dcdf0.jpg',
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Mai Văn Minh',
                'email' => 'coach4@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => 'https://kenh14cdn.com/thumb_w/660/2018/10/5/39504782498811223864807856893918233099078n-15364767743641856870093-1538706172491166907134.jpg',
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Đõ Minh Mạnh',
                'email' => 'coach5@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => 'http://phongtap.thehinh.com/wp-content/uploads/2017/04/cao-minh-tu-huan-luyen-vien-ca-nhan-4.jpg',
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Mai Anh Tài',
                'email' => 'coach6@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => 'https://phongtap.thehinh.com/wp-content/uploads/2017/04/cao-minh-tu-huan-luyen-vien-ca-nhan-1.jpg',
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            // [
            //     'name' => 'Tuấn Hưng',
            //     'email' => 'coachbx@gmail.com',
            //     'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
            //     'gender' => 1,
            //     'phone' => rand(1000000000,9999999999),
            //     'avatar' => fake()->imageUrl(),
            //     'wage'=>200000,
            //     'email_verified_at' => '2022-09-08 15:00:14',
            //     'address' => 'Hà nội',
            //     'status' => 1
            // ],
            // [
            //     'name' => 'Duy Mạnh',
            //     'email' => 'coachbx1@gmail.com',
            //     'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
            //     'gender' => 1,
            //     'phone' => rand(1000000000,9999999999),
            //     'avatar' => fake()->imageUrl(),
            //     'wage'=>200000,
            //     'email_verified_at' => '2022-09-08 15:00:14',
            //     'address' => 'Hà nội',
            //     'status' => 1
            // ],
            [
                'name' => 'Nguyễn Văn C',
                'email' => 'member1@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => fake()->imageUrl(),
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Nguyễn Văn Trường',
                'email' => 'member2@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => fake()->imageUrl(),
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Nguyễn Văn Khải',
                'email' => 'member3@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => fake()->imageUrl(),
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Nguyễn Văn Long',
                'email' => 'member4@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => fake()->imageUrl(),
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Nguyễn Văn Huy',
                'email' => 'member5@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => fake()->imageUrl(),
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            [
                'name' => 'Nguyễn Văn Hùng',
                'email' => 'member6@gmail.com',
                'password' => '$2a$12$onNtXT7kF7Iw4LA7nw8kFOBfMMl8kMC4qxb850m6Vg6e9ZNrfnVw2',
                'gender' => 1,
                'phone' => rand(1000000000,9999999999),
                'avatar' => fake()->imageUrl(),
                'wage'=>200000,
                'email_verified_at' => '2022-09-08 15:00:14',
                'address' => 'Hà nội',
                'status' => 1
            ],
            
        ];

        foreach ($users as $key => $user) {
            $user = User::create($user);
            $email = $user['email'];
            switch ($email) {
                case 'admin@gmail.com':
                    $userSetRole = User::where('email', 'admin@gmail.com')->first();
                    $userSetRole->assignRole('admin');
                    break;
                case 'manager@gmail.com':
                    $userSetRole = User::where('email', 'manager@gmail.com')->first();
                    $userSetRole->assignRole('manager');
                    break;
                case 'coach@gmail.com':
                    $userSetRole = User::where('email', 'coach@gmail.com')->first();
                    $userSetRole->assignRole('coach');
                    break;
                case 'coach2@gmail.com':
                    $userSetRole = User::where('email', 'coach2@gmail.com')->first();
                    $userSetRole->assignRole('coach');
                    break;
                case 'coach3@gmail.com':
                    $userSetRole = User::where('email', 'coach3@gmail.com')->first();
                    $userSetRole->assignRole('coach');
                    break;
                case 'coach4@gmail.com':
                    $userSetRole = User::where('email', 'coach4@gmail.com')->first();
                    $userSetRole->assignRole('coach');
                    break;
                case 'coach5@gmail.com':
                    $userSetRole = User::where('email', 'coach5@gmail.com')->first();
                    $userSetRole->assignRole('coach');
                    break;
                case 'coach6@gmail.com':
                    $userSetRole = User::where('email', 'coach6@gmail.com')->first();
                    $userSetRole->assignRole('coach');
                    break; 
                // case 'coachbx@gmail.com':
                //     $userSetRole = User::where('email', 'coachbx@gmail.com')->first();
                //     $userSetRole->assignRole('coachbx');
                //     break; 
                // case 'coachbx1@gmail.com':
                //     $userSetRole = User::where('email', 'coachbx1@gmail.com')->first();
                //     $userSetRole->assignRole('coachbx');
                //     break;  
                case 'member@gmail.com':
                    $userSetRole = User::where('email', 'member@gmail.com')->first();
                    $userSetRole->assignRole('member');
                    break;
            }
        }

        // User::factory(10)->create();

        $members = User::all();
        foreach ($members as $key => $member) {
            if(!in_array($member->email, ['admin@gmail.com', 'manager@gmail.com','coach@gmail.com','coach2@gmail.com', 'coach3@gmail.com', 'coach4@gmail.com','coach5@gmail.com', 'coach6@gmail.com','member@gmail.com'])){
                $member->assignRole('member');
            }
        }
    }
}
