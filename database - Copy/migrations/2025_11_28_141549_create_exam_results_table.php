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
        Schema::create('exam_results', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('student_id')->nullable();
    $table->string('student_code')->index();
    $table->string('subject');
    $table->integer('mark');
    $table->string('grade')->nullable();
    $table->date('exam_date');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
