<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'stage_id', 'due_date', 'total_tasks', 'completed_tasks'];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function stage()
    {
        return $this->belongsTo(ProjectStage::class, 'stage_id');
    }

    public function getProgressAttribute()
    {
        return $this->total_tasks > 0 ? round(($this->completed_tasks / $this->total_tasks) * 100) : 0;
    }
}