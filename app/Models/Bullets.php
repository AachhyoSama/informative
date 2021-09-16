<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bullets extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'descriptive_title',
        'icons'
    ];

    protected $casts = [
        'title' => 'json',
        'descriptive_title' => 'json'
    ];
}
