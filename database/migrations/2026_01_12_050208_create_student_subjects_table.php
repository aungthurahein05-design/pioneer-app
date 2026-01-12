<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_subjects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();

            // Optional fields (use if you want)
            $table->string('academic_year', 20)->nullable();  // 2025-2026
            $table->string('term', 50)->nullable();           // Term 1 / Term 2
            $table->string('status', 30)->default('active');  // active / dropped

            $table->timestamps();

            // prevent duplicate student+subject
            $table->unique(['student_id', 'subject_id', 'academic_year', 'term'], 'stu_sub_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_subjects');
    }
};
