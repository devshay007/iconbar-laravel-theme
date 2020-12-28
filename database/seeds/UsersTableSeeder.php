<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {   
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        $users = [
            [
                'id'             => (string) Str::uuid(),
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$KjopsXqbCq1NrrGYJe7rr./68LzZSGCas5XxBHHbG.9AF4mc3GPR.',
                'remember_token' => null,
                'mobile_no'      => '',
                'status'      =>1,
            ],
        ];
        User::insert($users);
    }
}
