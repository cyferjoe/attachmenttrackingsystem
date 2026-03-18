<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('opportunity_id')->constrained('opportunities')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->text('message')->nullable();
            $table->string('status')->default('pending')->index();
            $table->string('cover_letter_path')->nullable();
            $table->timestamps();

            $table->unique(['opportunity_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
