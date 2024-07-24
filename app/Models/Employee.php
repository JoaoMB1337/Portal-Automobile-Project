<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\EmployeeRole;
use App\Models\Contact;
use App\Models\DrivingLicense;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employee extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

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
        'google2fa_secret',
        'uses_two_factor_auth',
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
        return $this->belongsToMany(Trip::class, 'trip_employee_associations', 'employee_id', 'trip_id')
            ->with('project');    }

    public function drivingLicenses()
    {
        return $this->belongsToMany(DrivingLicense::class, 'employee_driving_licenses');
    }

    public function isAdmin()
    {
        return $this->employee_role_id == 1;
    }

    public function isManager()
    {
        return $this->employee_role_id == 2;

    }

    public function isMaster()
    {
        return $this->employee_role_id == 1 || $this->employee_role_id == 2;
    }

    public function isBaseEmployee()
    {
        return $this->employee_role_id == 3;
    }


}
