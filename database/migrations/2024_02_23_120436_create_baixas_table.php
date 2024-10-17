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
        Schema::create('baixas', function (Blueprint $table) {
            $table->id();
            $table->float('liters', 5, 2);
            $table->float('value', 7, 2);
            $table->dateTime('date');
            $table->integer('km')->nullable();
            $table->unsignedBigInteger('veiculo_id');
            $table->unsignedBigInteger('funcionario_id');
            $table->string('password')->nullable();

            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baixas');
    }
};
