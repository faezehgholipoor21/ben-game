<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribeHistoryUser extends Model
{
    use HasFactory;
    protected $table = 'subscribe_history_user';

    protected $fillable = [
        'user_id',
        'description',
        'subscribe_id',
        'price',
        'status',
    ];
}
