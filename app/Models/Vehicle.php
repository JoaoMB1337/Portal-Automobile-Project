<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate',
        'km',
        'condition',
        'is_external',
        'contract_number',
        'rental_price_per_day',
        'rental_start_date',
        'rental_end_date',
        'rental_company',
        'rental_contact_person',
        'rental_contact_number',
        'notes',
        'model_id',
        'fuel_type_id',
        'car_category_id',
        'brand_id',
    ];

    public function Vehiclemodel()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function carCategory()
    {
        return $this->belongsTo(CarCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


}
