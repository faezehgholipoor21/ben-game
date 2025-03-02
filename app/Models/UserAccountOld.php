<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccountOld extends Model
{
    use HasFactory;

    protected $table = 'user_accounts';
    protected $guarded = [];

    function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GameAccount::class, 'account_id');
    }

    function fieldInfo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GameAccountField::class, 'field_id');
    }
}
