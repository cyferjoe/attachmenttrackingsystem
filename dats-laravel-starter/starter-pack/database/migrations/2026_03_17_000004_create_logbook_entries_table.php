<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logbook_entries', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('lecturer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('opportunity_id')->nullable()->constrained('opportunities')->nullOnDelete();
            $table->unsignedInteger('week_number');
            $table->date('entry_date');
            $table->text('tasks_completed');
            $table->text('skills_gained')->nullable();
            $table->text('challenges')->nullable();
            $table->text('next_week_plan')->nullable();
            $table->text('lecturer_feedback')->nullable();
            $table->string('status')->default('submitted')->index();
            $table->timestamps();

            $table->unique(['student_id', 'week_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logbook_entries');
    }
};
