<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::insert([
            [
                'name' => 'Wordpress Developer',
                'department_id' => 1,
            ],
            [
                'name' => 'Graphic Designer',
                'department_id' => 2,
            ],
            [
                'name' => 'Seo Expert',
                'department_id' => 3,
            ],
        ]);
    }
}
