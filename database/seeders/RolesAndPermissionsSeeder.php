<?php

namespace Database\Seeders;

use App\Models\User;
use HasinHayder\Tyro\Models\Privilege;
use HasinHayder\Tyro\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $privileges = [
            'view-users' => 'View users',
            'create-users' => 'Create users',
            'edit-users' => 'Edit users',
            'delete-users' => 'Delete users',
            'suspend-users' => 'Suspend users',
            'view-roles' => 'View roles',
            'create-roles' => 'Create roles',
            'edit-roles' => 'Edit roles',
            'delete-roles' => 'Delete roles',
            'view-projects' => 'View projects',
            'create-projects' => 'Create projects',
            'edit-projects' => 'Edit projects',
            'delete-projects' => 'Delete projects',
            'approve-projects' => 'Approve projects',
            'view-transactions' => 'View transactions',
            'process-transactions' => 'Process transactions',
            'refund-transactions' => 'Refund transactions',
            'view-disputes' => 'View disputes',
            'resolve-disputes' => 'Resolve disputes',
            'view-settings' => 'View settings',
            'edit-settings' => 'Edit settings',
        ];

        $privilegeModels = [];
        foreach ($privileges as $slug => $name) {
            $privilegeModels[$slug] = Privilege::firstOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
        }

        $superAdminRole = Role::firstOrCreate(['slug' => 'super-admin'], ['name' => 'Super Admin']);
        $adminRole = Role::firstOrCreate(['slug' => 'admin'], ['name' => 'Admin']);
        $moderatorRole = Role::firstOrCreate(['slug' => 'moderator'], ['name' => 'Moderator']);
        $clientRole = Role::firstOrCreate(['slug' => 'client'], ['name' => 'Client']);
        $providerRole = Role::firstOrCreate(['slug' => 'provider'], ['name' => 'Provider']);

        foreach ($privilegeModels as $privilege) {
            $superAdminRole->attachPrivilege($privilege);
        }

        foreach ([
            'view-users',
            'create-users',
            'edit-users',
            'suspend-users',
            'view-projects',
            'edit-projects',
            'approve-projects',
            'view-transactions',
            'view-disputes',
            'resolve-disputes',
            'view-settings',
        ] as $slug) {
            $adminRole->attachPrivilege($privilegeModels[$slug]);
        }

        foreach ([
            'view-users',
            'view-projects',
            'edit-projects',
            'view-disputes',
            'resolve-disputes',
        ] as $slug) {
            $moderatorRole->attachPrivilege($privilegeModels[$slug]);
        }

        foreach ([
            'create-projects',
            'edit-projects',
            'view-projects',
        ] as $slug) {
            $clientRole->attachPrivilege($privilegeModels[$slug]);
        }

        foreach ([
            'view-projects',
        ] as $slug) {
            $providerRole->attachPrivilege($privilegeModels[$slug]);
        }

        $admin = User::firstOrCreate(
            ['email' => 'admin@salamapay.com'],
            [
                'full_name' => 'Super Admin',
                'phone' => '255712345678',
                'password' => Hash::make('password'),
                'kyc_status' => 'verified',
                'account_status' => 'active',
            ]
        );
        $admin->assignRole($superAdminRole);

        $client = User::firstOrCreate(
            ['email' => 'client@example.com'],
            [
                'full_name' => 'John Client',
                'phone' => '255723456789',
                'password' => Hash::make('password'),
                'kyc_status' => 'verified',
                'account_status' => 'active',
            ]
        );
        $client->assignRole($clientRole);

        $provider = User::firstOrCreate(
            ['email' => 'provider@example.com'],
            [
                'full_name' => 'Jane Provider',
                'phone' => '255734567890',
                'password' => Hash::make('password'),
                'kyc_status' => 'verified',
                'account_status' => 'active',
            ]
        );
        $provider->assignRole($providerRole);
    }
}
