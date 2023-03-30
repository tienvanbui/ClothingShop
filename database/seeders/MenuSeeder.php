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
            'slug'=>'trang-chu'
        ]);
        Menu::create([
            'name'=>'Cửa hàng',
            'parent_id'=>0,
            'slug'=>'cua-hang'
        ]);
        Menu::create([
            'name'=>'Nam',
            'parent_id'=>2,
            'slug'=>'nam'
        ]);
        Menu::create([
            'name'=>'Nữ',
            'parent_id'=>2,
            'slug'=>'nu'
        ]);
        Menu::create([
            'name'=>'Giỏ hàng',
            'parent_id'=>0,
            'slug'=>'gio-hang'
        ]);
        Menu::create([
            'name'=>'Tin tức',
            'parent_id'=>0,
            'slug'=>'tin-tuc'
        ]);
        Menu::create([
            'name'=>'Về chúng tôi',
            'parent_id'=>0,
            'slug'=>'ve-chung-toi'
        ]);
        Menu::create([
            'name'=>'Liên hệ',
            'parent_id'=>0,
            'slug'=>'lien-he'
        ]);
    }
}
