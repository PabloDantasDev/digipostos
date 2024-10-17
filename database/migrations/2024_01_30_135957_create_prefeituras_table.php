<?php

use App\Models\Prefeitura;
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
        Schema::create('prefeituras', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cnpj');
            $table->string('adress');
            $table->string('city');
            $table->string('uf');
            $table->string('contact');
            $table->string('mayor');
            $table->string('phone');
            $table->string('email');
            $table->string('logo')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prefeituras');
    }
};
