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
            'role_description'=>'Người toàn quyền quản lý ứng dụng'
        ]);
        Role::create([
            'role_name'=>'user',
            'role_description'=>'Người đã đăng ký tài khoản ứng dụng'
        ]);
       
    }
}
