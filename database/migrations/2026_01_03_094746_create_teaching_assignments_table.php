<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::create('teaching_assignments', function (Blueprint $table) {
        $table->id();

        $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
        $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
        $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();
        $table->foreignId('section_id')->nullable()->constrained('sections')->nullOnDelete();

        $table->timestamps();

        $table->unique(['teacher_id','subject_id','classroom_id','section_id'], 'ta_unique');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_assignments');
    }
};
