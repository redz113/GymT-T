<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultContract extends Model
{
    use HasFactory;
    protected $table = 'result_order';

    protected $fillable = [
        'user_id',
        'order_id',
        'height',
        'weight',
        'bmi',
        'comment',
        'status'
    ];

    public function order()
    {
        return $this->hasMany(Order::class,'id','order_id');
    }

}
