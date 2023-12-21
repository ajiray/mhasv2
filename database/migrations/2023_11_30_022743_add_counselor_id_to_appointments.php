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
    Schema::table('appointments', function (Blueprint $table) {
        $table->unsignedBigInteger('counselor_id')->nullable();
        $table->foreign('counselor_id')->references('id')->on('users')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('appointments', function (Blueprint $table) {
        $table->dropForeign(['counselor_id']);
        $table->dropColumn('counselor_id');
    });
}
};
