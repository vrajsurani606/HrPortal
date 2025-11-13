<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventVideo extends Model
{
    protected $fillable = ['event_id', 'video_path', 'mime', 'size'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
