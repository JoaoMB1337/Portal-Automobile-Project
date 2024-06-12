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
        Schema::table('employees', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('others_tables', function (Blueprint $table) {
            //
        });
    }
};
