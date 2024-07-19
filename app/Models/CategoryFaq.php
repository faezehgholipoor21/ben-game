<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFaq extends Model
{
    use HasFactory;

    protected $table = 'category_faq';
    protected $guarded = [];
}
