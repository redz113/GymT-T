<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance_member';
    

    protected $fillable = [
        'user_id',
        'order_id',
        'schedule_id',
        'time_id',
        'weekday_name',
        'pt_id',
        'date',
        'status'
    ];

    public function user(){  
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function pt(){  
        return $this->belongsTo(User::class,'pt_id','id');
    }

    public function time(){  
        return $this->belongsTo(Time::class,'time_id','id');
    }

    public function order(){  
        return $this->belongsTo(Order::class,'order_id','id');
    }

}
