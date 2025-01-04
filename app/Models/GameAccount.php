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

    function fields(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(GameAccountField::class, 'game_account_field_pivot', 'account_id', 'account_field_id');
    }
}
