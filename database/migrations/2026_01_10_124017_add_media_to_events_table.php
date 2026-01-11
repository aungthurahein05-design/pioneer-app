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
            //
                $table->string('image')->nullable()->after('description');
        $table->string('video')->nullable()->after('image'); 
        // video = mp4 path or YouTube URL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
             Schema::table('events', function (Blueprint $table) {
        $table->dropColumn(['image', 'video']);
    });
        });
    }
};
