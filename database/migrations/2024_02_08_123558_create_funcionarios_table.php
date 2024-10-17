<?php

use App\Models\Funcionario;
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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf');
            $table->string('rg');
            $table->string('sex');
            $table->unsignedBigInteger('posto_id');
            $table->string('phone')->nullable();
            $table->string('cellphone');
            $table->string('email');
            $table->string('password');
            $table->string('terms');

            $table->foreign('posto_id')->references('id')->on('postos');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
