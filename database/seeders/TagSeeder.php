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
        Tag::create(['tag_name'=>'Street Style']);
        Tag::create(['tag_name'=>'Beauty']);
        Tag::create(['tag_name'=>'Life Style']);
        Tag::create(['tag_name'=>'Fashion	']);
    }
}
