<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'address'=>'Tầng 5,Tòa nhà Ecolife,Tố Hữu,Nam Từ Liêm,Hà Nội',
            'talk'=>'0365932588',
            'sale_email'=>'tienvanbui1982001@gmail.com',
        ]);
    }
}
