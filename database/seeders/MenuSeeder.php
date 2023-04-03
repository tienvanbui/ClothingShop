<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'name'=>'Trang chủ',
            'parent_id'=>0,
            'slug'=>'home'
        ]);
        Menu::create([
            'name'=>'Cửa hàng',
            'parent_id'=>0,
            'slug'=>'shop'
        ]);
        Menu::create([
            'name'=>'Nam',
            'parent_id'=>2,
            'slug'=>'men'
        ]);
        Menu::create([
            'name'=>'Nữ',
            'parent_id'=>2,
            'slug'=>'women'
        ]);
        Menu::create([
            'name'=>'Giỏ hàng',
            'parent_id'=>0,
            'slug'=>'cart'
        ]);
        Menu::create([
            'name'=>'Tin tức',
            'parent_id'=>0,
            'slug'=>'blog'
        ]);
        Menu::create([
            'name'=>'Về chúng tôi',
            'parent_id'=>0,
            'slug'=>'about'
        ]);
        Menu::create([
            'name'=>'Liên hệ',
            'parent_id'=>0,
            'slug'=>'contact'
        ]);
    }
}
