<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;

class LinkEmployeesToUsersSeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::whereNull('user_id')->get();
        
        foreach ($employees as $employee) {
            if ($employee->email) {
                $user = User::where('email', $employee->email)->first();
                if ($user) {
                    $employee->update(['user_id' => $user->id]);
                    $this->command->info("Linked employee {$employee->name} to user {$user->name}");
                }
            }
        }
        
        $this->command->info('Employee-User linking completed.');
    }
}