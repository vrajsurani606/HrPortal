<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [];
        for ($i = 1; $i <= 5; $i++) {
            $code = Employee::nextCode();
            $name = 'Employee '.$i;
            $email = 'employee'.$i.'@example.com';

            $id = DB::table('employees')->insertGetId([
                'code' => $code,
                'name' => $name,
                'email' => $email,
                'mobile_no' => '98765'.str_pad((string)($i*123),5,'0',STR_PAD_LEFT),
                'address' => 'Street '.$i.', Surat',
                'position' => ['Web Dev.','UI/UX Dev.','Android Dev.'][($i-1)%3],
                'reference_name' => 'Ref '.$i,
                'reference_no' => '99250'.str_pad((string)($i*345),5,'0',STR_PAD_LEFT),
                'aadhaar_no' => '1234 5678 90'.str_pad((string)$i,2,'0',STR_PAD_LEFT),
                'pan_no' => 'ABCDE'.str_pad((string)$i,5,'0',STR_PAD_LEFT),
                'bank_name' => 'SBI',
                'bank_account_no' => '10020030'.str_pad((string)$i,2,'0',STR_PAD_LEFT),
                'bank_ifsc' => 'SBIN0000123',
                'experience_type' => $i%2 ? 'Experienced' : 'Fresher',
                'previous_company_name' => $i%2 ? 'Prev Co '.$i : null,
                'previous_salary' => $i%2 ? 25000 + $i*1500 : null,
                'current_offer_amount' => 30000 + $i*2000,
                'has_incentive' => (bool)($i%2),
                'incentive_amount' => $i%2 ? 2500 : null,
                'joining_date' => now()->subDays($i*7)->toDateString(),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('employee_socials')->insert([
                'employee_id' => $id,
                'location' => 'Surat, IN',
                'email' => $email,
                'phone' => '98765'.str_pad((string)($i*123),5,'0',STR_PAD_LEFT),
                'linkedin' => 'https://linkedin.com/in/example'.$i,
                'github' => 'https://github.com/example'.$i,
                'website' => 'https://portfolio'.$i.'.example.com',
                'current_position' => ['Web Dev.','UI/UX Dev.','Android Dev.'][($i-1)%3],
                'company_name' => 'Company '.$i,
                'skills' => 'PHP, Laravel, JavaScript, Tailwind',
                'hobbies' => 'Music, Reading',
                'total_experience_years' => $i%2 ? 2.5 + $i : 0,
                'summary' => 'Passionate developer with focus on quality.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('employee_languages')->insert([
                ['employee_id'=>$id,'language'=>'English','created_at'=>now(),'updated_at'=>now()],
                ['employee_id'=>$id,'language'=>'Hindi','created_at'=>now(),'updated_at'=>now()],
            ]);

            DB::table('employee_previous_roles')->insert([
                [
                    'employee_id'=>$id,
                    'title'=>'Developer',
                    'company'=>'Crest Data',
                    'from_date'=>now()->subYears(2)->toDateString(),
                    'to_date'=>now()->subYear()->toDateString(),
                    'description'=>'Worked on multiple web apps.',
                    'created_at'=>now(),'updated_at'=>now()
                ]
            ]);

            DB::table('employee_educations')->insert([
                [
                    'employee_id'=>$id,
                    'degree'=>'BCA',
                    'institute'=>'XYZ University',
                    'year'=>2019,
                    'description'=>'Computer Applications',
                    'created_at'=>now(),'updated_at'=>now()
                ]
            ]);

            DB::table('employee_certifications')->insert([
                [
                    'employee_id'=>$id,
                    'title'=>'Laravel Certification',
                    'issuer'=>'Online',
                    'year'=>2021,
                    'description'=>'Advanced Laravel',
                    'created_at'=>now(),'updated_at'=>now()
                ]
            ]);

            DB::table('employee_achievements')->insert([
                [
                    'employee_id'=>$id,
                    'title'=>'Best Performer',
                    'description'=>'Achieved top performer award',
                    'years'=>'2022',
                    'created_at'=>now(),'updated_at'=>now()
                ]
            ]);

            DB::table('employee_projects')->insert([
                [
                    'employee_id'=>$id,
                    'name'=>'HR Portal',
                    'description'=>'Internal HR management portal',
                    'link'=>'',
                    'created_at'=>now(),'updated_at'=>now()
                ]
            ]);

            DB::table('employee_profile_images')->insert([
                ['employee_id'=>$id,'image_path'=>'','created_at'=>now(),'updated_at'=>now()],
            ]);
        }
    }
}
