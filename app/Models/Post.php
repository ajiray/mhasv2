<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'anonymous', 'announcement'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
{
    return $this->hasMany(Comment::class);
}

public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

}
