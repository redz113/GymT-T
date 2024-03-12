<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'discount_id',
        'package_id',
        'date_start',
        'date_end',
        'pt_id',
        'total_money',
        'status',
        'payment_method'
    ];

    protected $attributes = [
        'status' => 0
    ];
    public function pt(){
        return $this->belongsTo(User::class,'pt_id','id');
    }


    public function package(){  
        return $this->belongsTo(Package::class,'package_id','id');
    }

    public function coupon(){  
        return $this->belongsTo(Discount::class,'discount_id','id');
    }
    
    public function time(){  
        return $this->belongsTo(Time::class,'time_id','id');
    }


    public function users(){
        return $this->belongsToMany(
            User::class,
            'result_order',
            'order_id',
            'user_id'    
        );
    }

    public function times(){
        return $this->belongsToMany(
            TrainingPackage::class,
            'training_package',
            'order_id',
            'time_id'    
        );
    }

    public function trainings()
    {
        return $this->hasMany(TrainingPackage::class,'order_id','id');
    }

    public function results()
    {
        return $this->hasMany(ResultContract::class,'order_id','id');
    }
    
}
