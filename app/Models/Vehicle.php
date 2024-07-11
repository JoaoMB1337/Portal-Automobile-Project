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

    public function updateStatus()
    {
        $today = Carbon::today();

        // Veículo externo ativo dentro do período de aluguel
        if ($this->is_external) {
            if ($today->greaterThanOrEqualTo($this->rental_start_date) && $today->lessThanOrEqualTo($this->rental_end_date)) {
                $this->is_active = true;
            } else {
                $this->is_active = false;
            }
        } else {
            $this->is_active = true;
        }

        // Desativar se o período de viagem terminou
        $activeTrips = $this->trips()->where('end_date', '>=', $today)->exists();
        if (!$activeTrips) {
            $this->is_active = false;
        }

        $this->save();
    }
}
