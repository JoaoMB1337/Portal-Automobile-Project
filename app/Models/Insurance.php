<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NumberFormatter;
use Carbon\Carbon;

class Insurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'insurance_company',
        'policy_number',
        'start_date',
        'end_date',
        'cost',
        'vehicle_id',
    ];

    protected $dates = ['start_date', 'end_date'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
