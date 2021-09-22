<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'contact_no',
        'province_no',
        'district_no',
        'local_address',
        'company_logo',
        'footer_logo',
        'company_favicon',
        'pan_vat',
        'projects_completed',
        'clients_satisfied',
        'award_winner',

        'facebook',
        'instagram',
        'whatsapp',
        'youtube',
        'twitter',

        'aboutus',
        'from_day',
        'to_day',
        'opening_time',
        'closing_time',

        'map_url',

        'meta_title',
        'meta_keywords',
        'meta_description',
        'og_image'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_no', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_no', 'id');
    }

    protected $casts = [
        'company_name' => 'json',
        'contact_no' => 'json',
        'local_address' => 'json',
        'projects_completed' => 'json',
        'clients_satisfied' => 'json',
        'award_winner' => 'json',
        'aboutus' => 'json'
    ];
}
