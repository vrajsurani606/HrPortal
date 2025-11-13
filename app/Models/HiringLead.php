<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HiringLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_code',
        'person_name',
        'mobile_no',
        'address',
        'position',
        'is_experience',
        'experience_count',
        'experience_previous_company',
        'previous_salary',
        'resume_path',
        'gender',
    ];

    protected $casts = [
        'is_experience' => 'boolean',
        'experience_count' => 'decimal:1',
        'previous_salary' => 'decimal:2',
    ];

    public static function nextCode(string $prefix = 'CMS/LEAD/'): string
    {
        $last = static::where('unique_code', 'like', $prefix.'%')
            ->orderByDesc('id')
            ->value('unique_code');

        $nextNumber = 1;
        if ($last) {
            $parts = explode('/', $last);
            $lastNum = intval(end($parts));
            $nextNumber = $lastNum + 1;
        }
        return $prefix . str_pad((string)$nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function offerLetter()
    {
        return $this->hasOne(OfferLetter::class, 'hiring_lead_id');
    }
}
