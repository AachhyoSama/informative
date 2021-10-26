<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPDF extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'member_id',
        'member_subcategory_id',
        'committee_id',
        'committee_subcategory_id',
        'pdf_file',
        'is_active',
    ];

    public function member()
    {
        return $this->belongsTo(Membercategory::class, 'member_id', 'id');
    }

    public function memberSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'member_subcategory_id', 'id');
    }

    public function committee()
    {
        return $this->belongsTo(Membercategory::class, 'committee_id', 'id');
    }

    public function committeeSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'committee_subcategory_id', 'id');
    }

    protected $casts = [
        'name' => 'json'
    ];
}
