<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'admin',
            'address' => 'Merul Badda, Dhaka',
            'phone' => '01751473993',
            'email' => 'admin@localhost.local',
            'birth_date' => '1994-02-28',
            'password' => Hash::make('admin'),
            'role' => '1',
        ]);
        User::factory(20)->create();
    }
}
