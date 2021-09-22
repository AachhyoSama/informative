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
        'is_active',

        'meta_title',
        'meta_keywords',
        'meta_description',
        'og_image'
    ];

    protected $casts = [
        'category_name' => 'json',
    ];
}
