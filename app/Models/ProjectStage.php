<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color', 'order'];

    public function projects()
    {
        return $this->hasMany(Project::class, 'stage_id');
    }
}