<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('prefeituras', function (Blueprint $table) {
            $table->string('password');
        });

        
        DB::table('roles')->insert([
            [
                'name' => 'prefeitura'
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
