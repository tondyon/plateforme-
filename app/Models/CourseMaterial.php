<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseMaterial extends Model
{
    use HasFactory;
    protected $fillable = ['course_id','file_path','file_type'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
