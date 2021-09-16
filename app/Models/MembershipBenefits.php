<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipBenefits extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'descriptive_title',
        'content',
        'cover_image'
    ];

    protected $casts = [
        'title' => 'json',
        'descriptive_title' => 'json',
        'content' => 'json',
    ];
}
