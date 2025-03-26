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
        Schema::create('students', function (Blueprint $table) {
            $table->string('studID')->primary();
            $table->string('email')->unique();
            $table->string('name',100);
            $table->string('faculty',255);
            $table->string('programme',255);
            $table->integer('year',5);
            $table->integer('sem',5);
            $table->integer('group',5);
           $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
