<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    use HasFactory;

    protected $table = 'wages';

    protected $fillable = [
        'user_id',
        'wage_month',
        'session',
        'total_wage',
        'month',
        'year',
        'status',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
