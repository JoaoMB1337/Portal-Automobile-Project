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
            $table->boolean('is_external')->nullable(false);
            $table->string('contract_number')->nullable(false);
            $table->decimal('rental_price_per_day', 10, 2)->nullable(false);
            $table->date('rental_start_date')->nullable(false);
            $table->date('rental_end_date')->nullable(false);
            $table->string('rental_company')->nullable(false);
            $table->string('rental_contact_person')->nullable(false);
            $table->string('rental_contact_number')->nullable(false);
            $table->string('notes');
            $table->foreignId('model_id')->nullable(false)->constrained('models');
            $table->foreignId('fuel_type_id')->nullable(false)->constrained('fuel_types');
            $table->foreignId('car_category_id')->nullable(false)->constrained('car_categories');
            $table->foreignId('brand_id')->nullable(false)->constrained('brands');
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
