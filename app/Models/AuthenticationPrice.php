<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthenticationPrice extends Model
{
    use HasFactory;

    protected $table = 'authentication_price';
    protected $guarded = [];
}
