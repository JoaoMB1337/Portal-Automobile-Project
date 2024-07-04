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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('employee_number')->unique()->nullable();
            $table->string('gender')->nullable(false);
            $table->date('birth_date')->nullable(false);
            $table->string('CC')->nullable(false)->unique();
            $table->string('NIF')->nullable(false)->unique();
            $table->string('address')->nullable();
            $table->foreignId('employee_role_id')->constrained();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('first_login')->default(true);
            $table->string('google2fa_secret')->nullable(); // Adicionar este campo
            $table->boolean('uses_two_factor_auth')->default(false); // Adicionar este campo
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
