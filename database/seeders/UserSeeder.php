<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin Kevin',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'address'=>'Di Trach,Hoai Duc,Ha Noi',
            'phoneNumber'=>'03468279380',
            'password'=>Hash::make('admin12345'),
            'role_id'=>1,
        ]);
        User::create([
            'name'=>'Join Kevin',
            'email'=>'user123@gmail.com',
            'username'=>'user',
            'password'=>Hash::make('user12345'),
            'role_id'=>2,
            'address'=>'Trung Ha,Thuy Nguyen,Hai Phong',
            'phoneNumber'=>'0365932700',

        ]);
    }
}
