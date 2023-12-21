<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounselingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_number',
        'findings',
        'present_conditions',
        'conclusions',
        'recommendations',
        'difficulties',
        'background_of_study',
    ];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
