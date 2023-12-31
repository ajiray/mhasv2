<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;

    protected $table = 'summary'; // Specify the table name if it's different

    protected $fillable = [
        'student_id',
        'counselor_id',
        'course',
        'reason',
        'type',
        'date',
    ];

    // Define relationships or additional methods as needed
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function counselor()
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }
}
