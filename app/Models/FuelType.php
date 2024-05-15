<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
