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
        $defaultRoles = ['Administrator', 'Guest'];
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
        $this->createRoles($defaultRoles);
        $this->createPermissions($defaultPermissions);
        $this->syncRolesAndPermissions($defaultRoles, $defaultPermissions);
    }

    private function initUsers($defaultRoles): void
    {
        $users = User::withTrashed()->get();

        foreach ($users as $user) {
            if ($user->id === 1) {
                $user->syncRoles($defaultRoles[0]);
            }

            if ($user->id > 1) {
                $user->syncRoles($defaultRoles[1]);
            }
        }
    }

    private function createRoles($defaultRoles): void
    {
        foreach ($defaultRoles as $role) {
            Role::create([
                'name' => $role,
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }

    private function createPermissions($defaultPermissions): void
    {
        $allPermissions = array_merge(
            $defaultPermissions['Administrator'],
            $defaultPermissions['Guest'],
        );

        foreach ($allPermissions as $permission) {
            Permission::create([
                'name' => $permission,
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }

    private function syncRolesAndPermissions($defaultRoles, $defaultPermissions): void
    {
        foreach ($defaultRoles as $role) {
            $role = Role::where('name', $role)->first();

            if ($role->name === $defaultRoles[0]) {
                $role->syncPermissions(array_merge($defaultPermissions['Administrator'], $defaultPermissions['Guest']));
            }

            if ($role->name === $defaultRoles[1]) {
                $role->syncPermissions($defaultPermissions['Guest']);
            }
        }
    }
}
