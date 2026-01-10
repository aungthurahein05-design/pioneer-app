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
    Schema::table('events', function (Blueprint $table) {
        $table->date('event_date')->nullable()->after('title');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
            //

            Schema::table('events', function (Blueprint $table) {
    $table->date('event_date')->nullable()->after('title');
    $table->string('location')->nullable()->after('event_date');
    $table->text('description')->nullable()->after('location');
    $table->string('link')->nullable()->after('description');
    $table->string('photo')->nullable()->after('link');
});
      
    }
};
