<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'project_status_id',
        'country_id',
    ];

    public function projectStatus()
    {
        return $this->belongsTo(ProjectStatus::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    
}
