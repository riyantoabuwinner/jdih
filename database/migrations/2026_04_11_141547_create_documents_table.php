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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('number')->nullable();
            $table->year('year');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('draft'); // draft, review, published, archived
            $table->text('abstract')->nullable();
            $table->string('file_path')->nullable();
            $table->date('date_of_establishment')->nullable(); // Tanggal penetapan
            $table->date('date_of_promulgation')->nullable(); // Tanggal pengundangan
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('published_at')->nullable();
            $table->integer('view_count')->default(0);
            $table->integer('download_count')->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
