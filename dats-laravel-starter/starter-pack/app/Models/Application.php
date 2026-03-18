<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'opportunity_id',
        'student_id',
        'message',
        'status',
        'cover_letter_path',
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
