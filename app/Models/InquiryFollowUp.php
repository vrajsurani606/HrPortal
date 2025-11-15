<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryFollowUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'followup_date',
        'next_followup_date',
        'demo_status',
        'scheduled_demo_date',
        'scheduled_demo_time',
        'demo_date',
        'demo_time',
        'remark',
        'inquiry_note',
        'is_confirm',
    ];

    protected $casts = [
        'followup_date' => 'date',
        'next_followup_date' => 'date',
        'scheduled_demo_date' => 'date',
        'demo_date' => 'date',
        'is_confirm' => 'boolean',
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }
}
