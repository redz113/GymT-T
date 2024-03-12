<?php
namespace App\Http\Services;

class UploadImgService {
    public static function uploadImg($file, $prefix, $type = null){

        if(!isset($file))
        {
           return null; 
        } 
        $ext = $file->extension();
        $file_name = time().'-'.rand(10,100).'user.'.$ext;
        if(!$type){
            $filePath = $file->move(public_path($prefix), $file_name);
        }
        else{
            $filePath = $file->move(public_path($type.'/'. $prefix), $file_name);
        }
            // $file_name='kkk.jpg';
        return $file_name;
        
        
    }

    public static function nameWeekday($weekday_id){
        $weekday_name = "";
        switch ($weekday_id) {
            case '1':
                $weekday_name = "Monday";
                break;
            case '2':
                $weekday_name = "Tuesday";
                break;
            case '3':
                $weekday_name = "Wednesday";
                break;
            case '4':
                $weekday_name = "Thursday";
                break;
            case '5':
                $weekday_name = "Friday";
                break;
            case '6':
                $weekday_name = "Saturday";
                break;
            case '7':
                $weekday_name = "Sunday";
                break;
            default:
                # code...
                break;
                return $weekday_name;
        }
    }
}