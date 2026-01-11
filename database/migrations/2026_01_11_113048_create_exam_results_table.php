<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();

            // optional: who entered marks
            $table->foreignId('teacher_id')->nullable()->constrained()->nullOnDelete();

            // Exam identity
            $table->string('exam_type');                 // Monthly / Midterm / Final / Quiz
            $table->string('exam_name')->nullable();     // "Final Exam 2026"
            $table->string('academic_year')->nullable(); // "2025-2026"
            $table->string('term')->nullable();          // "Term 1"
            $table->date('result_date');                 // filter by month/year

            // Marks
            $table->decimal('score', 6, 2)->nullable();
            $table->decimal('max_score', 6, 2)->nullable();
            $table->decimal('percentage', 6, 2)->nullable();
            $table->string('grade_letter')->nullable();  // A/B/C...
            $table->boolean('pass_fail')->nullable();    // 1 pass, 0 fail

            // Control
            $table->string('status')->default('draft');  // draft/published/locked
            $table->text('remarks')->nullable();

            $table->timestamps();

            // prevent duplicates
            $table->unique(['student_id','subject_id','exam_type','result_date'], 'uniq_exam_result');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
