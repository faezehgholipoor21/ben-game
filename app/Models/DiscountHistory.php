<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountHistory extends Model
{
    use HasFactory;
    protected $table = 'discount_history';
    protected $guarded = [];
}
