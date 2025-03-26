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
        Schema::create('exam', function (Blueprint $table) {
            $table->id();
            $table->string('studID'); 
            $table->string('courseID', 255);
            $table->string('grade'); // Letter Grade (A, B, F, etc.)
            $table->decimal('marks', 5, 2)->nullable()->default(null);
            $table->decimal('avgStud', 5, 2)->nullable()->default(null);
            $table->decimal('avgSub', 5, 2)->nullable()->default(null);
            $table->string('remarks')->nullable(); // Remarks (e.g., Failed)v
            $table->timestamps();

            $table->foreign('studID')->references('studID')->on('students')->onDelete('cascade');
            $table->foreign('courseID')->references('courseID')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam');
    }
};
