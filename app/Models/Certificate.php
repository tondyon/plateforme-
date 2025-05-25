<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'user_id',
        'issued_at',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];
}
