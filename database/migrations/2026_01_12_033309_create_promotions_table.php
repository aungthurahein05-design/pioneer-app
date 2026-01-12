<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained()->cascadeOnDelete();

            $table->foreignId('from_classroom_id')->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('from_section_id')->constrained('sections')->cascadeOnDelete();

            $table->foreignId('to_classroom_id')->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('to_section_id')->constrained('sections')->cascadeOnDelete();

            $table->string('from_academic_year', 20)->nullable();
            $table->string('to_academic_year', 20)->nullable();

            $table->text('note')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'to_classroom_id', 'to_section_id', 'to_academic_year'], 'promo_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
