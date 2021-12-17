<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    private array $permissions = [];
    private array $roles = [];

    /**
     * This seeder seeds all defined roles and permissions.
     * If a certain role or permission needs to be changed/added, simply change it here, and it'll be updated on the next run.
     * Just keep in mind that it uses the name of the role/permission as the search key, so if you change the name of the role/permission, you'll need to update some things manually.
     *
     * Note from me:
     * I'm pretty proud of this seeder lmao. I wanted to find an efficient way to manage permissions and roles,
     * since I never really found a good way to implement role & permission seeding yet, without manually having to create them on every environment.
     *
     * This seems to limit code duplication better than any other solution I've seen so far, so I see it as a win!
     * If it actually is a good solution though, I'll leave that up to you to decide.
     *
     * @return void
     */
    public function run(): void
    {
        $this->seedRoles();
        $this->seedPermissions();
        $this->assignPermissionsToRoles();
    }

    private function seedRoles(): void
    {
        // The array of roles to be seeded
        $roleList = [
            [
                'name' => 'player',
                'color' => '#8bc34a',
            ],
            [
                'name' => 'event manager',
                'color' => '#1565c0',
                'description' => 'Responsible for preparing, carrying out and reviewing all official events with the Event Team to deliver you a smooth and organised experience, each time better than the last.',
            ],
        ];

        foreach ($roleList as $role) {
            // Create or update the role, and assign it to the array of roles
            $this->roles[$role['name']] = Role::query()->updateOrCreate([
                'name' => $role['name'],
            ], $role);
        }
    }

    private function seedPermissions(): void
    {
        // The array of permissions to be seeded
        $permissionList = [
            [
                'name' => 'manage event requests',
            ]
        ];

        foreach ($permissionList as $permission) {
            // Create or update the permission, and assign it to the array of permissions
            $this->permissions[$permission['name']] = Permission::query()->updateOrCreate([
                'name' => $permission['name'],
            ], $permission);
        }
    }

    private function assignPermissionsToRoles(): void
    {
        $roles = $this->roles;
        $permissions = $this->permissions;

        $roles['event manager']->givePermissionTo($permissions['manage event requests']);
    }
}
