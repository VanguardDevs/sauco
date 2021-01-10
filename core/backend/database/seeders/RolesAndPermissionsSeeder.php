<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    private $permissionsByRole = [
        'Admin' => [
            'access.economic-activities',
            'edit.economic-activities',
            'create.economic-activities',
            'access.reports',
            'access.licenses',
            'access.settings',
            'edit.settings'
        ],
        'Auditor' => [
            'access.economic-activities',
            'access.reports',
            'access.settings',
            'access.licenses'
        ],
        'Root' => []
    ];

    private function createPermissions()
    {
        $permissionsValues = array_values($this->permissionsByRole);
        $permissions = array_merge(...$permissionsValues);

        foreach (array_unique($permissions) as $permission) {
            Permission::create(['name' => $permission]);
        }
    }

    private function createRoles()
    {
        // Get permissions
        $permissionsByRole = fn ($role) => collect($this->permissionsByRole[$role])
            ->map(fn ($name) => Permission::whereName($name)->first());

        // Create roles
        foreach ($this->permissionsByRole as $roleName => $permissions) {
            $role = Role::create(['name' => $roleName]);
            $permissions = $permissionsByRole($roleName);

            $role->syncPermissions($permissions);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->createPermissions();
        $this->createRoles();
    }
}
