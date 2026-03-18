<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'reg_no',
        'department',
        'role',
        'password',
        'api_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, 'lecturer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'student_id');
    }

    public function logbookEntries()
    {
        return $this->hasMany(LogbookEntry::class, 'student_id');
    }

    public function reviews()
    {
        return $this->hasMany(LogbookEntry::class, 'lecturer_id');
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function isLecturer(): bool
    {
        return $this->role === 'lecturer';
    }
}
