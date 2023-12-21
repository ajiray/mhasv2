<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('accepted_appointments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Admin who accepted the appointment
        $table->unsignedBigInteger('appointment_id'); // The ID of the accepted appointment
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accepted_appointments');
    }
};
