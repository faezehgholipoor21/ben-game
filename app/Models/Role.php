<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $guarded = [];

    protected $casts = [
      'role_id' => 'integer',
      'user_id' => 'integer',
    ];

    function users() {
        return $this->belongsToMany(User::class);
    }
}
