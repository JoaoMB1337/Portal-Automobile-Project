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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate')->nullable(false);
            $table->integer('km')->nullable(false);
            $table->string('condition')->nullable(false);
            $table->boolean('is_external')->nullable();
            $table->string('contract_number')->nullable();
            $table->decimal('rental_price_per_day', 10, 2)->nullable();
            $table->date('rental_start_date')->nullable();
            $table->date('rental_end_date')->nullable();
            $table->string('rental_company')->nullable();
            $table->string('rental_contact_person')->nullable();
            $table->string('rental_contact_number')->nullable();
            $table->string('notes')->nullable();
            $table->foreignId('fuel_type_id')->constrained('fuel_types');
            $table->foreignId('car_category_id')->constrained('car_categories');
            $table->foreignId('brand_id')->constrained('brands');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
