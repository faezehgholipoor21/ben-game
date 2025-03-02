<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccountDetail extends Model
{
    use HasFactory;

    protected $table = 'user_account_detail';
    protected $guarded = [];

    public function user_account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserAccount::class);
    }

    function fieldInfo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GameAccountField::class, 'field_id');
    }
}
