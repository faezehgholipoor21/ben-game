<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $casts = [
        'expired_time' => 'datetime',
    ];

    protected $table = 'discounts';
    protected $guarded = [];

    protected $fillable = [
        'discount_code',
        'discount_name',
        'expired_time',
        'limit',
        'used',
        'status',
        'percentage',
        'auto_discount',
        'cat_id'
    ];


}
