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
        Color::create(['color_name'=>'White']);
        Color::create(['color_name'=>'Black']);
        Color::create(['color_name'=>'Gray']);
        Color::create(['color_name'=>'Blue']);
    }
}
