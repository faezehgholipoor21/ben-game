<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    protected $table = 'user_account';
    protected $guarded = [];

    function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GameAccount::class, 'account_id');
    }

    public function user_account_details(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserAccountDetail::class);
    }
}
