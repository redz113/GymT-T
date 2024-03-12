<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPackage extends Model
{
    use HasFactory;
    protected $table = 'training_package';
    
    protected $fillable = [
        'order_id',
        'weekday_id',
        'time_id',
    ];
}
