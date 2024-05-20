<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
