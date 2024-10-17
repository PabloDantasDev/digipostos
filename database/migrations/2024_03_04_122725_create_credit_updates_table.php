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
        Schema::create('credit_updates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credito_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('datetime');
            $table->float('old_value');
            $table->float('new_value');
            $table->float('old_fuel');
            $table->float('new_fuel');
            $table->string('old_validity');
            $table->string('new_validity');

            $table->foreign('credito_id')->references('id')->on('creditos');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_updates');
    }
};
