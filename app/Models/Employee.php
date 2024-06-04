<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\EmployeeRole;
use App\Models\Contact;
use App\Models\DrivingLicense;


class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'employee_number',
        'gender',
        'birth_date',
        'CC',
        'NIF',
        'address',
        'employee_role_id',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(EmployeeRole::class, 'employee_role_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }


    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'trip_employee_associations');
    }

    public function drivingLicenses()
    {
        return $this->belongsToMany(DrivingLicense::class, 'employee_driving_licenses');
    }

    public function isAdmin() {
        return $this->employee_role_id == 2;
    }




}
