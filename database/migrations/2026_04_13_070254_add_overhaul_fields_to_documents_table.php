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
            $table->longText('content_html')->nullable()->after('abstrak');
            $table->string('legal_status')->default('active')->after('status');
            $table->string('access_level')->default('public')->after('legal_status');
            $table->string('territory_level')->default('internal')->after('access_level');
            $table->string('document_function')->default('regulative')->after('territory_level');
            $table->foreignId('subject_id')->nullable()->after('category_id')->constrained('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn([
                'content_html', 
                'legal_status', 
                'access_level', 
                'territory_level', 
                'document_function',
                'subject_id'
            ]);
        });
    }
};
