<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GameAccount extends Model
{
    use HasFactory;

    protected $table = 'game_account';
    protected $guarded = [];

    function fieldInfo(): HasMany
    {
        return $this->hasMany(GameAccountField::class, 'account_name_id', 'id');
    }
}
