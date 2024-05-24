<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost',
        'trip_id',
        'cost_type_id',
        'file',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function costType()
    {
        return $this->belongsTo(CostType::class);
    }
}
