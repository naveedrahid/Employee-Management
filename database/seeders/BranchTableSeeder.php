<?php

namespace Database\Seeders;

use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::insert([
            [
                'name' => 'Gulshan Branch',
                'country_id' => 1,
                'city_id' => 1,
                'address' => 'D 13, Gulshan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Clifton Branch',
                'country_id' => 2,
                'city_id' => 60,
                'address' => 'DHA phase 2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Shah Faisal Branch',
                'country_id' => 1,
                'city_id' => 2,
                'address' => 'PECHS Phase 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
