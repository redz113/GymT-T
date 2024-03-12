<?php

use App\Models\Language;
use App\Models\Order;
use App\Models\Rate;
use App\Models\Translation;


function test_bmi($bmi)
{
    $health = 0;
    if ($bmi < 16) {
        $health = 1;
    } else if ($bmi < 17) {
        $health = 2;
    } else if ($bmi < 18.5) {
        $health = 3;
    } else if ($bmi < 25) {
        $health = 4;
    } else if ($bmi < 30) {
        $health = 5;
    } else if ($bmi < 35) {
        $health = 6;
    } else if ($bmi < 40) {
        $health = 7;
    } else {
        $health = 8;
    }
    return $health;
}

function starPackage($id)
{
    $avg = Rate::where('package_id', $id)->avg('star_package');
    $star_rate = $avg == null ? 5 : $avg;
    return $star_rate;
}

function starPt($id)
{
    $avg = Rate::where('pt_id', $id)->avg('star_pt');
    $star_rate = $avg == null ? 5 : $avg;
    return $star_rate;
}

function upload_image($name, $request, $new, $folder)
{
    $image = $request;
    $imageName = $image->hashName();
    $new->$name = $image->move($folder, $imageName);
}

function config_encode($text)
{
    $data = strtoupper(md5(rand(0, 1000)) . "gym") . base64_encode($text);
    return $data;
}

function weekday($weekday)
{
    $weekday_name = "";
    switch ($weekday) {
        case 'Monday':
            $weekday_name = "Thứ 2";
            break;
        case 'Tuesday':
            $weekday_name = "Thứ 3";
            break;
        case 'Wednesday':
            $weekday_name = "Thứ 4";
            break;
        case 'Thursday':
            $weekday_name = "Thứ 5";
            break;
        case 'Friday':
            $weekday_name = "Thứ 6";
            break;
        case 'Saturday':
            $weekday_name = "Thứ 7";
            break;
        case 'Sunday':
            $weekday_name = "Chủ nhật";
            break;
        default:
            # code...
            break;
            return $weekday_name;
    }
}


function st($month, $year)
{  // Thống kê
    if ($month < 10) {
        $month = "0" . $month;
    }
    $total_turnover = Order::where('status', 1)->get();
    $total = 0;
    foreach ($total_turnover as $item) {
        if (date('m-Y', strtotime($item->date_start)) == "$month" . "-" . "$year") {
            $total += $item->total_money;
        }
    }
    return $total;
}

function sub($month, $year)
{  // Thống kê đăng ký mới
    if ($month < 10) {
        $month = "0" . $month;
    }
    $total_sub = Order::where('status', 1)->get();
    $total = 0;
    foreach ($total_sub as $item) {
        if (date('m-Y', strtotime($item->date_start)) === "$month" . "-" . "$year") {
            $total += 1;
        }
    }
    return $total;
}

function config_decode($text)
{
    $result = substr($text, 35);
    return (int)base64_decode($result);
}


function typePackage()
{
    return [
        '1' => 'Gói ngày',
        '2' => 'Gói tháng'
    ];
}
function statusWage()
{
    return [
        '0' => 'Chưa quyết toán',
        '1' => 'Đã quyết toán'
    ];
}

function gender()
{
    return [
        '0' => 'Nữ',
        '1' => 'Nam',
        '2' => 'Khác'
    ];
}

function statusTT()
{
    return [
        '0' => 'Chưa thanh toán',
        '1' => 'Đã thanh toán',
    ];
}
function evaluate()
{
    return [
        '1' => 'Rất tệ',
        '2' => 'Tệ',
        '3' => 'Hài lòng',
        '4' => 'Tốt',
        '5' => 'Rất tốt'
    ];
}
