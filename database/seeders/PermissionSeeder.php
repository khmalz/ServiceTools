<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $clientPermissions = [
            'service_access',
            'service_create',
            'appointment_access',
            'appointment_create'
        ];

        $technisianPermissions = [
            'service_access',
            'service_edit',
            'appointment_access',
            'appointment_edit',
            'activity_access',
        ];

        $adminPermissions = [
            'technician_access',
            'technician_manage',
            'service_access',
            'service_edit',
            'appointment_access',
            'appointment_edit',
            'activity_access',
        ];

        $allPermission = array_unique(array_merge($clientPermissions, $technisianPermissions, $adminPermissions));

        foreach ($allPermission as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $role = Role::create(['name' => 'admin']);
        foreach ($adminPermissions as $permission) {
            $role->givePermissionTo($permission);
        }

        $role = Role::create(['name' => 'technician']);
        foreach ($technisianPermissions as $permission) {
            $role->givePermissionTo($permission);
        }

        $role = Role::create(['name' => 'client']);
        foreach ($clientPermissions as $permission) {
            $role->givePermissionTo($permission);
        }
    }
}
