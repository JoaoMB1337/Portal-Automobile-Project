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
        'fuel_type_id',
        'car_category_id',
        'brand_id',
    ];

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

    public function insurances()
    {
        return $this->hasMany(Insurance::class);
    }

    public function vehicleCondition()
    {
        return $this->belongsTo(VehicleCondition::class);
    }


}
