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
        Schema::create('summary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('counselor_id');
            $table->string('course');
            $table->text('reason');
            $table->date('date');
            $table->timestamps();

            // Index the date column for efficient filtering
            $table->index('date');

            // Foreign keys
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('counselor_id')->references('id')->on('counselors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summary');
    }
};
