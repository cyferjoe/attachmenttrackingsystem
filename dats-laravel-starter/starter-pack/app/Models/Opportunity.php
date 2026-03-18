<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecturer_id',
        'title',
        'organization_name',
        'location',
        'description',
        'requirements',
        'status',
        'application_deadline',
    ];

    protected function casts(): array
    {
        return [
            'application_deadline' => 'date',
        ];
    }

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function logbookEntries()
    {
        return $this->hasMany(LogbookEntry::class);
    }
}
