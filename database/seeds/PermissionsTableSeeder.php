<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {      
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Permission::truncate();
        $permissions = [
            [
                'id'    => (string) Str::uuid(),
                'title' => 'user_management_access',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'permission_create',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'permission_edit',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'permission_show',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'permission_delete',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'permission_access',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'role_create',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'role_edit',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'role_show',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'role_delete',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'role_access',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'user_create',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'user_edit',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'user_show',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'user_delete',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'user_access',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}
