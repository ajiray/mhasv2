<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'email',
        'student_number',
        'course',
        'password',
        'is_admin',
        'avatar',
        'first_login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function feed() {
        return $this->hasMany(Post::class, 'user_id');
    }
    
    public function appointment() {
        return $this->hasMany(Appointment::class, 'counselor_id');
    }

    public function isAdmin()
    {
        return $this->is_admin === 1;
    }

    public function sentMessages()
    {
        return $this->hasMany(ChMessage::class, 'from_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(ChMessage::class, 'to_id');
    }

    public function notSeenMessagesCount()
    {
        return $this->receivedMessages()->where('seen', 0)->count();
    }
    
}
