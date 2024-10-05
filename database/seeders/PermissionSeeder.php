<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::query()->truncate();

        $data = [
            // user
            ['name' => 'user_read'],
            ['name' => 'user_create'],
            ['name' => 'user_update'],
            ['name' => 'user_delete'],

            // role
            ['name' => 'role_read'],
            ['name' => 'role_create'],
            ['name' => 'role_update'],
            ['name' => 'role_delete'],

            // settings
            ['name' => 'settings_read'],
            ['name' => 'settings_create'],
            ['name' => 'settings_update'],
            ['name' => 'settings_delete'],

            // banner
            ['name' => 'banner_read'],
            ['name' => 'banner_create'],
            ['name' => 'banner_update'],
            ['name' => 'banner_delete'],

            // enquiry
            ['name' => 'enquiry_read'],
            ['name' => 'enquiry_create'],
            ['name' => 'enquiry_update'],
            ['name' => 'enquiry_delete'],

            // cms_category
            ['name' => 'cms_category_read'],
            ['name' => 'cms_category_create'],
            ['name' => 'cms_category_update'],
            ['name' => 'cms_category_delete'],

            // services
            ['name' => 'services_read'],
            ['name' => 'services_create'],
            ['name' => 'services_update'],
            ['name' => 'services_delete'],

            // bank
            ['name' => 'bank_read'],
            ['name' => 'bank_create'],
            ['name' => 'bank_update'],
            ['name' => 'bank_delete'],
            ['name' => 'bank_export'],
        ];

        // Insert data into the database
        foreach ($data as $record) {
            Permission::query()->create($record);
        }
    }
}
