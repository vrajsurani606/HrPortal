<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'cover_image_id'];

    public function images(): HasMany
    {
        return $this->hasMany(EventImage::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(EventVideo::class);
    }

    public function coverImage()
    {
        return $this->belongsTo(EventImage::class, 'cover_image_id');
    }
}
