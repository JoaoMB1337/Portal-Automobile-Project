<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
