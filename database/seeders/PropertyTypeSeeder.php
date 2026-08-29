<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $property_type = [
            [
                'name_kh' => 'ដី',
                'name_en' => 'Land',
            ],
            [
                'name_kh' => 'ឃ្លាំង',
                'name_en' => 'Warehouse',
            ],
            [
                'name_kh' => 'អាផាតមិន',
                'name_en' => 'Apartment',
            ],
            [
                'name_kh' => 'ផ្ទះល្វែង',
                'name_en' => 'Flat',
            ],
            [
                'name_kh' => 'ផ្ទះ-បន្ទប់ជួល',
                'name_en' => 'Housing Complex',
            ],
        ];
        foreach ($property_type as $property_types) {
            PropertyType::create($property_types);
        }
    }
}
