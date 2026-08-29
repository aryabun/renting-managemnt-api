<?php

namespace Database\Seeders;

use App\Models\UnitType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unit_type = [
            [
                'name_en' => 'Single',
                'name_kh' => 'តែមួយបន្ទប់់',
            ],
            [
                'name_en' => 'Multiple',
                'name_kh' => 'ច្រើនបន្ទប់',
            ]
        ];
        foreach ($unit_type as $unit_types) {
            UnitType::create($unit_types);
        }
    }
}
