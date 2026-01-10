<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('student_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('grade_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Exam info
            $table->string('exam_name');          // Midterm, Final, Monthly
            $table->string('subject')->nullable();

            // Marks
            $table->decimal('score', 6, 2)->nullable();
            $table->decimal('max_score', 6, 2)->nullable();

            // Date (for filter)
            $table->date('result_date');

            // Status & remarks
            $table->enum('status', ['Pass', 'Fail', 'Absent'])->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};

