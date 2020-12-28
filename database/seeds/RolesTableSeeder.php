<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    public function run()
    {   
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Role::truncate();
        $roles = [
            [
                'id'    => (string) Str::uuid(),
                'title' => 'Admin',
            ],
            [
                'id'    => (string) Str::uuid(),
                'title' => 'User',
            ],
        ];
        Role::insert($roles);
    }
}
