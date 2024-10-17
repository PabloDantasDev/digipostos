<?php

use App\Models\Veiculo;
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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('license_plate');
            $table->string('model');
            $table->integer('year');
            $table->string('productor');
            $table->string('color');
            $table->string('fuel');
            $table->float('tank_capacity', 5, 2);
            $table->integer('initial_km');
            $table->integer('final_km');

            $table->unsignedBigInteger('prefeitura_id');
            $table->unsignedBigInteger('secretaria_id');

            $table->foreign('prefeitura_id')->references('id')->on('prefeituras');
            $table->foreign('secretaria_id')->references('id')->on('secretarias');
            
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
