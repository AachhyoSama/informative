<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_category_name',
        'slug',
        'category_id',
        'is_active',

        'meta_title',
        'meta_keywords',
        'meta_description',
        'og_image'
    ];

    protected $casts = [
        'sub_category_name' => 'json',
    ];

    public function category()
    {
        return $this->belongsTo(Membercategory::class, 'category_id');
    }
}
