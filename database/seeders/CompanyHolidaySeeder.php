<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyHoliday;
use Carbon\Carbon;

class CompanyHolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = 2025;
        
        $holidays = [
            ['name' => 'New Year', 'date' => "$year-01-01", 'description' => 'New Year Day'],
            ['name' => 'Republic Day', 'date' => "$year-01-26", 'description' => 'Republic Day of India'],
            ['name' => 'Holi', 'date' => "$year-03-14", 'description' => 'Festival of Colors'],
            ['name' => 'Good Friday', 'date' => "$year-04-18", 'description' => 'Good Friday'],
            ['name' => 'Eid ul-Fitr', 'date' => "$year-04-21", 'description' => 'Eid ul-Fitr'],
            ['name' => 'Independence Day', 'date' => "$year-08-15", 'description' => 'Independence Day of India'],
            ['name' => 'Janmashtami', 'date' => "$year-08-26", 'description' => 'Krishna Janmashtami'],
            ['name' => 'Gandhi Jayanti', 'date' => "$year-10-02", 'description' => 'Mahatma Gandhi Birthday'],
            ['name' => 'Dussehra', 'date' => "$year-10-12", 'description' => 'Vijayadashami'],
            ['name' => 'Diwali', 'date' => "$year-10-31", 'description' => 'Festival of Lights'],
            ['name' => 'Guru Nanak Jayanti', 'date' => "$year-11-15", 'description' => 'Guru Nanak Birthday'],
            ['name' => 'Christmas', 'date' => "$year-12-25", 'description' => 'Christmas Day'],
        ];

        foreach ($holidays as $holiday) {
            CompanyHoliday::create([
                'name' => $holiday['name'],
                'date' => $holiday['date'],
                'year' => $year,
                'description' => $holiday['description'],
                'is_active' => true,
            ]);
        }

        $this->command->info("Company holidays for $year seeded successfully!");
    }
}
