<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {	
    	\DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('role_user')->truncate();
        User::first()->roles()->sync(Role::where('title','Admin')->first());
    }
}
