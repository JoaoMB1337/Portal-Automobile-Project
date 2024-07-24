<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'plate',
        'km',
        'condition',
        'fuel_type_id',
        'car_category_id',
        'brand_id',
        'passenger_quantity',
        'is_active',
        'is_external',
        'rental_start_date',
        'rental_end_date',
        'rental_price_per_day',
        'rental_company',
        'rental_contact_person',
        'rental_contact_number'
    ];

    protected $attributes = [
        'is_external' => false,
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

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'trip_vehicle_associations');
    }

    public function getTotalRentalCostAttribute()
    {
        $rentalStartDate = Carbon::parse($this->rental_start_date);
        $rentalEndDate = Carbon::parse($this->rental_end_date);

        $days = $rentalStartDate->diffInDays($rentalEndDate) + 1; 

        return $days * $this->rental_price_per_day;
    }

    
}
