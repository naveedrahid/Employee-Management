<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveType::insert([
            [
                'name' => 'Sick Leave',
                'category' => 'sick',
                'max_days' => 10,
                'gender_specific' => false,
                'aplicable_for' => 'all',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '14 August',
                'category' => 'religious',
                'max_days' => 1,
                'gender_specific' => false,
                'aplicable_for' => 'all',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Maternity Leave',
                'category' => 'maternity',
                'max_days' => 14,
                'gender_specific' => true,
                'aplicable_for' => 'female',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
