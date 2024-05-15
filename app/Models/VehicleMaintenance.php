<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMaintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'maintenance_date',
        'description',
        'cost',
        'maintenance_type_id',
        'vehicle_id',
    ];

    public function maintenanceType()
    {
        return $this->belongsTo(MaintenanceType::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
