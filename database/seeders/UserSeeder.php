<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        User::query()->truncate();

        $data = [
            [
                'name' => 'Rental Admin',
                'email' => 'rentaladmin@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => 1,
                'role_id' => 1
            ],
            [
                'name' => 'Test User',
                'email' => 'testdmin@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => 1,
                'role_id' => 2
            ],
        ];

        // Insert data into the database
        foreach ($data as $record) {
            User::query()->create($record);
        }
    }
}
