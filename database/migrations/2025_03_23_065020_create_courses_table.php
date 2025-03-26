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
        Schema::create('courses', function (Blueprint $table) {
            $table->string('courseID',255)->primary(); //courseCode
            $table->string('lecID');
            $table->string('courseName',255);
            $table->integer('creditHours');
            $table->boolean('paperType')->default(false); // Main false, Elective true
           // $table->integer('year');
            //$table->integer('sem');
            $table->timestamps();

            $table->foreign('lecID')->references('lecID')->on('lecturers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
