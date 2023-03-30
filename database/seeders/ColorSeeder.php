<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;
class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create(['color_name'=>'Trắng']);
        Color::create(['color_name'=>'Đen']);
        Color::create(['color_name'=>'Xám']);
        Color::create(['color_name'=>'Xanh']);
    }
}
