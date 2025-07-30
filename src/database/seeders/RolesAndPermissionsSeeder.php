<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Administrator',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $permissions = [
            'users.index',
            'users.create',
            'users.edit',
            'users.show',
            'users.destroy',
            'roles.index',
            'roles.create',
            'roles.edit',
            'roles.show',
            'roles.destroy',
            'permissions.index',
            'permissions.create',
            'permissions.edit',
            'permissions.show',
            'permissions.destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }

        $role->syncPermissions($permissions);
    }
}
