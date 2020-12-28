<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {   
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('permission_role')->truncate();
        $admin_permissions = Permission::all();
        Role::where('title','Admin')->first()->permissions()->sync($admin_permissions->pluck('id'));
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_'
                && substr($permission->title, 0, 5) != 'role_'
                && substr($permission->title, 0, 11) != 'permission_'
                && substr($permission->title, 0, 6) != 'asset_';
        });
        Role::where('title','User')->first()->permissions()->sync($user_permissions);
    }
}
