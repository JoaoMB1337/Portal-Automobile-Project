<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_date',
        'vehicle_id',
        'vehicle_inspection_status_id',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

}
