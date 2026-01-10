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
    Schema::create('enrolls', function (Blueprint $table) {
        $table->id();
        $table->string('name');          // Student name
        $table->string('nrc');           // NRC
        $table->enum('gender', ['male','female']);
        $table->string('father_name');
        $table->string('mother_name');
        $table->date('dob');             // birthday
        $table->string('phone');
        $table->string('address');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('enrolls');
}

};
