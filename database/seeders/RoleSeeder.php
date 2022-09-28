<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_name'=>'admin',
            'role_description'=>'the person who is a manager of website'
        ]);
        Role::create([
            'role_name'=>'user',
            'role_description'=>'the person who had an account'
        ]);
       
    }
}
