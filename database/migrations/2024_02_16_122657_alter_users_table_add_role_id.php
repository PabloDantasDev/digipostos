<?php

use App\Models\User;
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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->after('password');
            $table->foreign('role_id')->references('id')->on('roles')->default(2);

            $table->unsignedInteger('department_id')->nullable();
        });

        User::factory()->create([
            'email' => 'admin@email.com',
            'role_id' => 1,
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
