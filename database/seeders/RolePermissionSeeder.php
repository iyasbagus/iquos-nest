<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // bikin permission
        $permissions = [
            'manage_assets',
            'manage_users',
            'view_dashboard',
            'upload_assets',
            'view_stats',
            'download_assets'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //bikin role
        $admin = Role::create(['name' => 'admin']);
        $creator = Role::create(['name' => 'creator']);
        $user = Role::create(['name' => 'user']);

        //ngasih permission ke role
        $admin->givePermissionTo(Permission::all());
        $creator->givePermissionTo(['upload_assets','view_stats']);
        $user->givePermissionTo(['download_assets']);
    }
}
