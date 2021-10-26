<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_photo',
        'name',
        'email',
        'contact_no',
        'address',
        'position',
        'member_id',
        'commitee_id',
        'member_subcategory_id',
        'committee_subcategory_id',
        'details',

        'facebook',
        'whatsapp',
        'youtube',
        'twitter',
        'linkedin',

        'in_order'
    ];

    public function memberCategory()
    {
        return $this->belongsTo(Membercategory::class, 'member_id', 'id');
    }

    public function commiteeCategory()
    {
        return $this->belongsTo(Membercategory::class, 'commitee_id', 'id');
    }

    protected $casts = [
        'name' => 'json',
        'contact_no' => 'json',
        'address' => 'json',
        'position' => 'json',
        'details' => 'json'
    ];
}
