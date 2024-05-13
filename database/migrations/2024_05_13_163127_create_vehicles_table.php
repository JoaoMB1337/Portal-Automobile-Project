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
            $table->string('plate');
            $table->integer('km');
            $table->string('condition');
            $table->boolean('is_external');
            $table->string('contract_number');
            $table->decimal ('rental_price_per_day', 10, 2);
            $table->date('rental_start_date');
            $table->date('rental_end_date');
            $table->string('rental_company');
            $table->string('rental_contact_person');
            $table->string('rental_contact_number');
            $table->string('notes');
            $table->foreignId('model_id')->constrained('models');
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
