<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CompanyHoliday extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'year',
        'description',
        'is_active',
    ];

    protected $casts = [
        'date' => 'date',
        'year' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Check if a given date is a company holiday
     */
    public static function isHoliday($date)
    {
        $date = Carbon::parse($date);
        return static::where('date', $date->format('Y-m-d'))
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Get holidays for a specific year
     */
    public static function getHolidaysForYear($year)
    {
        return static::where('year', $year)
            ->where('is_active', true)
            ->orderBy('date')
            ->get();
    }

    /**
     * Get upcoming holidays
     */
    public static function getUpcomingHolidays($limit = 5)
    {
        return static::where('date', '>=', now()->format('Y-m-d'))
            ->where('is_active', true)
            ->orderBy('date')
            ->limit($limit)
            ->get();
    }
}
