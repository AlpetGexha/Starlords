<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $premissions = [
            'admin_show',

            'post_access',
            'post_delete',
            'post_edit',
            'post_show',

            'category_access',
            'category_edit',
            'category_delete',
            'category_show',

            'user_delete',
            'user_edit',
            'user_show',
            'user_give_role',
            'user_make_role',
            'user_give_verify',
            'user_give_ban',
            'user_give_unban',

            'team_access',
            'team_create',
            'team_delete',

            'contact_access',
            'contact_delete',

            'blog_access',
            'blog_create',
            'blog_delete',

            'role_delete',
            'role_edit',
            'role_show',
            'role_create',

            'permission_delete',
            'permission_edit',
            'permission_show',

            'settings_access',
            'settings_update',
            'settings_delete',
            'settings_create',

            'audits_show',
        ];

        foreach ($premissions as $premission) {
            Permission::create(['name' => $premission]);
        }

        $admin = Role::create(['name' => 'SuperAdmin']);

        // Create user with superadmin role
        User::create([
            'name' => 'SuperAdmin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@gmail.com',
            'is_verified' => true,
        ])->assignRole($admin);


        foreach ($premissions as $premission) {
            $admin->givePermissionTo($premission);
        }
    }
}
