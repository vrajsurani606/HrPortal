<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'unique_code',
        'quotation_title',
        'quotation_date',
        'customer_type',
        'customer_id',
        'gst_no',
        'pan_no',
        'company_name',
        'company_type',
        'nature_of_work',
        'city',
        'scope_of_work',
        'address',
        'contact_person_1',
        'contact_number_1',
        'position_1',
        'contract_copy_path',
        'contract_details',
        'company_email',
        'company_password',
        'amc_start_date',
        'amc_amount',
        'project_start_date',
        'completion_time',
        'retention_time',
        'retention_amount',
        'tentative_complete_date',
        'contract_amount',
        'status',
    ];

    protected $casts = [
        'quotation_date' => 'date',
        'amc_start_date' => 'date',
        'project_start_date' => 'date',
        'tentative_complete_date' => 'date',
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }
}
