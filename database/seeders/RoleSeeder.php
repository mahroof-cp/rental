<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::query()->truncate();

        $data = [
            [
                'name' => 'Rental Admin',
                'is_active' => 1
            ],
            [
                'name' => 'Test Role',
                'is_active' => 1
            ],
        ];

        // Insert data into the database
        foreach ($data as $record) {
            Role::query()->create($record);
        }
    }
}
