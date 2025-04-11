<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::insert([
            'user_id' => 1,
            'branch_id' => 1,
            'department_id' => 1,
            'position_id' => 1,
            'city_id' => 1,
            'country_id' => 1,
            'employment_type' => 'full-time',
            'position_status' => 'lead',
            'joining_date' => now(),
            'dob' => now(),
            'image' => null,
            'gender' => 'male',
            'address' => 'United States, bird street, New York',
            'marital_status' => 'married',
            'status' => 'active', 
        ]);
    }
}
