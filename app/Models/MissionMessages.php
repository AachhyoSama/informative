<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionMessages extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_vision',
        'founder_message',
        'welcome_title',
        'welcome_sub_title',
        'welcome_message'
    ];

    protected $casts = [
        'mission_vision' => 'json',
        'founder_message' => 'json',
        'welcome_title' => 'json',
        'welcome_sub_title' => 'json',
        'welcome_message' => 'json'
    ];
}
