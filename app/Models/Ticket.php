<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_no',
        'subject',
        'status',
        'priority',
        'assigned_to',
        'opened_by',
        'opened_at',
        'work_status',
        'category',
        'customer',
        'title',
        'description',
        'company',
        'ticket_type',
    ];
}
