<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'condition',
    ];

    public function vehicle()
    {
        return $this->hasMany(Vehicle::class);
    }
}
