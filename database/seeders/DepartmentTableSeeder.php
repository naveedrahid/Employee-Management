<?php

namespace Database\Seeders;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds. 
     */
    public function run(): void
    {
        Department::insert([
            [
                'branch_id' => 1,
                'name' => 'Product Management',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'branch_id' => 2,
                'name' => 'Sales Management',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'branch_id' => 3,
                'name' => '3d Animation',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
