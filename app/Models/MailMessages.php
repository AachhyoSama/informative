<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailMessages extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'subject',
        'message',
        'is_read'
    ];
}
