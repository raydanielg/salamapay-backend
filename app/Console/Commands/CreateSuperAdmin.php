<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use HasinHayder\Tyro\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tyro:superadmin {email} {password} {name=Super Admin} {--role=super-admin} {--phone=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a superadmin user for the Tyro Dashboard';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = $this->argument('name');
        $roleSlug = (string) ($this->option('role') ?: 'super-admin');
        $phone = $this->option('phone');

        $userModel = config('auth.providers.users.model');

        $user = $userModel::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'user_type' => 'admin',
                'is_active' => true,
                'phone' => is_string($phone) && $phone !== '' ? $phone : null,
            ]
        );

        if (method_exists($user, 'assignRole')) {
            $roleName = match ($roleSlug) {
                'admin' => 'Admin',
                default => 'Super Admin',
            };
            $role = Role::firstOrCreate(['slug' => $roleSlug], ['name' => $roleName]);
            $user->assignRole($role);
        }

        $this->info('Admin credentials created/updated successfully!');
        $this->line('Email: ' . $email);
        $this->line('Password: ' . $password);
        $this->line('Role: ' . $roleSlug);
    }
}
