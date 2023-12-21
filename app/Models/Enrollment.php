<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $table = 'enrollment_records';

    protected $fillable = [
        'fullname',
        'email',
        'student_number',
        'birthday',
        'course',
        // ... other fields
    ];

    // If you want to disable timestamps (created_at, updated_at)
    public $timestamps = false;
}
