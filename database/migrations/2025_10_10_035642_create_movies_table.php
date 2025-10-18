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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('description')->nullable();
            $table->year('year')->nullable();
            $table->string('director')->nullable();
            $table->string('genre')->nullable();
            $table->string('poster_url')->nullable();
            $table->string('trailer_url')->nullable();

            // avg_rating để lưu điểm trung bình, decimal(3,2) để lưu điểm như 9.99
            $table->decimal('avg_rating', 3, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
