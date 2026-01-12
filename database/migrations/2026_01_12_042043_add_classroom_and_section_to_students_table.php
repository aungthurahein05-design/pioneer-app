<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {

            // Add ONLY if they do not exist (safe for repeat projects)
            if (!Schema::hasColumn('students', 'classroom_id')) {
                $table->foreignId('classroom_id')
                      ->nullable()
                      ->after('id')
                      ->constrained('classrooms')
                      ->nullOnDelete();
            }

            if (!Schema::hasColumn('students', 'section_id')) {
                $table->foreignId('section_id')
                      ->nullable()
                      ->after('classroom_id')
                      ->constrained('sections')
                      ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'classroom_id')) {
                $table->dropForeign(['classroom_id']);
                $table->dropColumn('classroom_id');
            }

            if (Schema::hasColumn('students', 'section_id')) {
                $table->dropForeign(['section_id']);
                $table->dropColumn('section_id');
            }
        });
    }
};
