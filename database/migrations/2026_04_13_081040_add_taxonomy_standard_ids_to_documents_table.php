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
        Schema::table('documents', function (Blueprint $table) {
            $table->foreignId('territory_id')->nullable()->after('subject_id')->constrained('categories')->onDelete('set null');
            $table->foreignId('function_id')->nullable()->after('territory_id')->constrained('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['territory_id']);
            $table->dropForeign(['function_id']);
            $table->dropColumn(['territory_id', 'function_id']);
        });
    }
};
