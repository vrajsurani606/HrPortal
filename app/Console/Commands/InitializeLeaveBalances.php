<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\LeaveBalance;

class InitializeLeaveBalances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leaves:initialize {year?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize leave balances for all employees for a given year';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $year = $this->argument('year') ?? now()->year;
        
        $this->info("Initializing leave balances for year {$year}...");
        
        $employees = Employee::all();
        $count = 0;
        
        foreach ($employees as $employee) {
            $balance = LeaveBalance::initializeForEmployee($employee->id, $year);
            
            if ($balance->wasRecentlyCreated) {
                $count++;
                $this->line("✓ Initialized balance for {$employee->name}");
            } else {
                $this->line("- Balance already exists for {$employee->name}");
            }
        }
        
        $this->info("\nCompleted! Initialized {$count} new leave balance records.");
        
        return Command::SUCCESS;
    }
}
