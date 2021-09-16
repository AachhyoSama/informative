<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'opening_advertisement',
        'opening_advertisement_url',
        'is_show',

        'header_advertisement',
        'header_advertisement_url',

        'middle_ad_one',
        'middle_ad_one_url',

        'middle_ad_two',
        'middle_ad_two_url',

        'middle_ad_three',
        'middle_ad_three_url',

        'middle_ad_four',
        'middle_ad_four_url',

        'main_advertisement',
        'main_advertisement_url'
    ];
}
