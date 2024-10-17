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
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->float('value', 8, 2);
            $table->string('fuel');
            $table->float('value_per_liter', 7, 4);
            $table->unsignedBigInteger('veiculo_id');
            $table->unsignedBigInteger('posto_id');
            $table->string('validity');

            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->foreign('posto_id')->references('id')->on('postos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditos');
    }
};
