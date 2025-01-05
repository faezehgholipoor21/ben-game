<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultAccount extends Model
{
    use HasFactory;

    protected $table = 'default_accounts';
    protected $guarded = [];
}
