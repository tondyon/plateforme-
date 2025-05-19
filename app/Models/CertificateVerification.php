<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateVerification extends Model
{
    protected $fillable = [
        'verification_code',
        'ip_address',
        'user_agent'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}