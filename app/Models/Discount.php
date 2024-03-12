<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discounts';

    protected $fillable = [
        'discount_title',
        'discount_code',
        'price_sale',
        'quantity',
        'package_id',
        'start_date',
        'end_date',
        'status'
    ];

    protected $attributes = [
        'status' => 1
    ];
}
