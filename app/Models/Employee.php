<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'employees';

    protected $fillable = [
        'name',
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
}
