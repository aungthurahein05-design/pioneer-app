<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
        $table->id();
        
        $table->string('student_code')->unique();
        $table->string('name');
        $table->string('gender')->nullable();
        $table->date('date_of_birth')->nullable();
        $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
        $table->foreignId('section_id')->constrained()->cascadeOnDelete();
        $table->year('admission_year')->nullable();
        $table->integer('roll_number')->nullable();
        $table->string('father_name')->nullable();
        $table->string('mother_name')->nullable();
        $table->string('guardian_phone')->nullable();
        $table->text('address')->nullable();
        $table->string('phone')->nullable();
        $table->string('email')->nullable();
        $table->string('status')->default('active');
        $table->string('photo')->nullable();
        $table->text('remarks')->nullable();

        $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};