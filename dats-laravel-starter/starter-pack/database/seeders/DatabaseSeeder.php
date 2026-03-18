<?php

namespace Database\Seeders;

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $lecturer = User::firstOrCreate(
            ['email' => 'lecturer@jkuat.ac.ke'],
            [
                'name' => 'Demo Lecturer',
                'department' => 'BBIT',
                'role' => 'lecturer',
                'password' => Hash::make('password123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'student@students.jkuat.ac.ke'],
            [
                'name' => 'Demo Student',
                'reg_no' => 'HDB212-0248/2022',
                'department' => 'BBIT',
                'role' => 'student',
                'password' => Hash::make('password123'),
            ]
        );

        Opportunity::firstOrCreate(
            ['title' => 'Software Support Attachment'],
            [
                'lecturer_id' => $lecturer->id,
                'organization_name' => 'JKUAT ICT Directorate',
                'location' => 'Juja',
                'description' => 'Support users, troubleshoot systems, and assist with campus ICT operations.',
                'requirements' => 'Basic PHP, networking, and documentation skills.',
                'status' => 'open',
                'application_deadline' => now()->addWeeks(2)->toDateString(),
            ]
        );

        Opportunity::firstOrCreate(
            ['title' => 'Web Development Attachment'],
            [
                'lecturer_id' => $lecturer->id,
                'organization_name' => 'Innovation Hub',
                'location' => 'Nairobi',
                'description' => 'Assist in Laravel development, UI integration, and testing.',
                'requirements' => 'HTML, CSS, Bootstrap, JavaScript, and PHP basics.',
                'status' => 'open',
                'application_deadline' => now()->addWeeks(3)->toDateString(),
            ]
        );
    }
}
