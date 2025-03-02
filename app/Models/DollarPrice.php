<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DollarPrice extends Model
{
    use HasFactory;

    protected $table = 'dollar_price';
    protected $guarded = [];
}
