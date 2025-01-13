<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultAccount extends Model
{
    use HasFactory;

    protected $table = 'default_accounts';
    protected $guarded = [];

    function userAccount(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserAccount::class, 'unique_form', 'unique_form');
    }

    function accountInfo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GameAccount::class, 'account_id');
    }
}
