<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleInspectionStatus extends Model
{
    use HasFactory;

    protected $fillable = ['status_name'];


    public function vehicleInspections()
    {
        return $this->hasMany(VehicleInspection::class);
    }
}
