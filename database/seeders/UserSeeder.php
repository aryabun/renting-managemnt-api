<?php
namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name'  => 'Admin',
            'last_name'   => 'Super',
            'email'       => 'admin@admin.com',
            'role'     => 'super-admin',
            'password'    => Hash::make('admin'),
            'created_at'  => Carbon::now()->toDateTimeString(),
        ]);
    }
}
