<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['contact_value',
               'contact_type_id',
               'employee_id'];

    public function contactType()
    {
        return $this->belongsTo(ContactType::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
