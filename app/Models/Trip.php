<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'start_date',
        'end_date',
        'destination',
        'purpose',
        'employee_id',
        'project_id',
        'vehicle_id',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'trip_employee_associations');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function typeTrip()
    {
        return $this->belongsTo(TypeTrip::class);
    }

    public function tripDetails()
    {
        return $this->hasMany(TripDetail::class);
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'trip_vehicle_associations');
    }
}
