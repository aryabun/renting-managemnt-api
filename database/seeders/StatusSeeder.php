<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            [
                'name_kh' => 'ទំនេរ',
                'name_en' => 'Available',
            ],
            [
                'name_kh' => 'មិនទំនេរ',
                'name_en' => 'Occupied',
            ],
            [
                'name_kh' => 'កំពុងជួសជុល',
                'name_en' => 'Maintenance',
            ],
            [
                'name_kh' => 'បានកក់',
                'name_en' => 'Reserved',
            ],
        ];
        foreach ($status as $statuses) {
            Status::create($statuses);
        }
    }
}
