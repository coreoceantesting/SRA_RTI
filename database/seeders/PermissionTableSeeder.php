<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id' => 1,
                'name' => 'dashboard.view',
                'group' => 'dashboard',
            ],
            [
                'id' => 2,
                'name' => 'users.view',
                'group' => 'users',
            ],
            [
                'id' => 3,
                'name' => 'users.create',
                'group' => 'users',
            ],
            [
                'id' => 4,
                'name' => 'users.edit',
                'group' => 'users',
            ],
            [
                'id' => 5,
                'name' => 'users.delete',
                'group' => 'users',
            ],
            [
                'id' => 6,
                'name' => 'users.toggle_status',
                'group' => 'users',
            ],
            [
                'id' => 7,
                'name' => 'users.change_password',
                'group' => 'users',
            ],
            [
                'id' => 8,
                'name' => 'roles.view',
                'group' => 'roles',
            ],
            [
                'id' => 9,
                'name' => 'roles.create',
                'group' => 'roles',
            ],
            [
                'id' => 10,
                'name' => 'roles.edit',
                'group' => 'roles',
            ],
            [
                'id' => 11,
                'name' => 'roles.delete',
                'group' => 'roles',
            ],
            [
                'id' => 12,
                'name' => 'roles.assign',
                'group' => 'roles',
            ],
            [
                'id' => 13,
                'name' => 'wards.view',
                'group' => 'wards',
            ],
            [
                'id' => 14,
                'name' => 'wards.create',
                'group' => 'wards',
            ],
            [
                'id' => 15,
                'name' => 'wards.edit',
                'group' => 'wards',
            ],
            [
                'id' => 16,
                'name' => 'wards.delete',
                'group' => 'wards',
            ],
            [
                'id' => 17,
                'name' => 'RTI.create',
                'group' => 'RTI',
            ],
            [
                'id' => 18,
                'name' => 'RTI.list',
                'group' => 'RTI',
            ],
            [
                'id' => 19,
                'name' => 'RTI.edit',
                'group' => 'RTI',
            ],
            [
                'id' => 20,
                'name' => 'RTI.firstAppealList',
                'group' => 'RTI',
            ],
            [
                'id' => 21,
                'name' => 'RTI.firstAppeal',
                'group' => 'RTI',
            ],
            [
                'id' => 22,
                'name' => 'RTI.transferDetails',
                'group' => 'RTI',
            ],
            [
                'id' => 23,
                'name' => 'RTI.approval',
                'group' => 'RTI',
            ],
            [
                'id' => 24,
                'name' => 'RTI.note',
                'group' => 'RTI',
            ],
            [
                'id' => 25,
                'name' => 'RTI.delete',
                'group' => 'RTI',
            ],
            [
                'id' => 26,
                'name' => 'Masters.all',
                'group' => 'Masters',
            ],
        ];

        foreach ($permissions as $permission)
        {
            Permission::updateOrCreate([
                'id' => $permission['id']
            ], [
                'id' => $permission['id'],
                'name' => $permission['name'],
                'group' => $permission['group']
            ]);
        }
    }
}
