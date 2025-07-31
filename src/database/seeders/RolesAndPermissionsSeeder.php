<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MD5:3858f62230ac3c915f300c664312c63f
        $defaultRoles = ['Guest', 'Administrator'];
        $defaultPermissions['Guest'] = [
            // MD5:11e4094c95d46ccb8cc60dd9bb905742
            'users.index',
            'roles.index',
            'permissions.index',
        ];
        $defaultPermissions['Administrator'] = [
            'users.create',
            'users.edit',
            'users.show',
            'users.destroy',
            'roles.create',
            'roles.edit',
            'roles.show',
            'roles.destroy',
            'permissions.create',
            'permissions.edit',
            'permissions.show',
            'permissions.destroy',
        ];

        $this->initRolesAndPermissions($defaultRoles, $defaultPermissions);
        $this->initUsers($defaultRoles);
    }

    private function initRolesAndPermissions($defaultRoles, $defaultPermissions): void
    {
        foreach ($defaultRoles as $defaultRole) {
            $role = Role::create([
                'name' => $defaultRole,
                'created_by' => 1,
                'updated_by' => 1,
            ]);

            foreach ($defaultPermissions[$defaultRole] as $permission) {
                Permission::create([
                    'name' => $permission,
                    'created_by' => 1,
                    'updated_by' => 1,
                ]);
            }

            if ($defaultRole === 'Administrator') {
                $role->syncPermissions(array_merge(
                        $defaultPermissions['Administrator'],
                        $defaultPermissions['Guest'],
                    )
                );
            }

            if ($defaultRole === 'Guest') {
                $role->syncPermissions($defaultPermissions[$defaultRole]);
            }
        }
    }

    private function initUsers($defaultRoles): void
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->id === 1) {
                $user->syncRoles($defaultRoles[1]);
            }

            if ($user->id > 1) {
                $user->syncRoles($defaultRoles[0]);
            }
        }
    }
}
