<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover_image',
        'title',
        'slug',
        'descriptive_title',
        'content',
        'written_on',
        'author',
        'view_count',
        'news_blogs'
    ];

    protected $casts = [
        'title' => 'json',
        'descriptive_title' => 'json',
        'content' => 'json'
    ];
}
