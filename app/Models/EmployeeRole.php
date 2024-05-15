<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRole extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }


}
