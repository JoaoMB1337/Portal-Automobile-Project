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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date')->nullable(false);
            $table->dateTime('end_date')->nullable(false);
            $table->string('destination')->nullable(false);
            $table->string('purpose')->nullable(false);
            $table->foreignId('employee_id')->constrained('employees')->nullable(false);
            $table->foreignId('project_id')->constrained()->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
