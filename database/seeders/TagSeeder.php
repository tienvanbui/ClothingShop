<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['tag_name'=>'Thể thao']);
        Tag::create(['tag_name'=>'Hiện đại']);
        Tag::create(['tag_name'=>'Thường ngày']);
        Tag::create(['tag_name'=>'Thời trang']);
    }
}
