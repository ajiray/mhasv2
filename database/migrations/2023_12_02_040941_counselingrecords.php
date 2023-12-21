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
        Schema::create('counseling_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // This assumes you're using Laravel 7 or later
            $table->text('findings');
            $table->text('present_conditions');
            $table->text('conclusions');
            $table->text('recommendations');
            $table->text('difficulties');
            $table->text('background_of_study');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
