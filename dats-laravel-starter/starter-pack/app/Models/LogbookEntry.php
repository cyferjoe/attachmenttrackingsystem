<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogbookEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'lecturer_id',
        'opportunity_id',
        'week_number',
        'entry_date',
        'tasks_completed',
        'skills_gained',
        'challenges',
        'next_week_plan',
        'lecturer_feedback',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'entry_date' => 'date',
        ];
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}
