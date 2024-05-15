<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    use HasFactory;

    protected $fillable = ['status_name', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
