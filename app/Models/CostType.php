<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostType extends Model
{
    use HasFactory;

    protected $fillable = ['type_name'];

    public function tripDetails()
    {
        return $this->hasMany(TripDetail::class);
    }


}
