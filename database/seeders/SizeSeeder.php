<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;
class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::create(['size_name' =>'S']);
        Size::create(['size_name' =>'M']);
        Size::create(['size_name' =>'L']);
        Size::create(['size_name' =>'XL']);
    }
}
