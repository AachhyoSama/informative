<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membercategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'slug',
        'member_commities',
        'is_active'
    ];

    protected $casts = [
        'category_name' => 'json',
    ];
}
