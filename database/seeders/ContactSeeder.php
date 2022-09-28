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
            'address'=>'Address Coza Store Center 8th floor, 379 Hudson St, New York, NY 10018 US',
            'talk'=>'+1 800 1236879',
            'sale_email'=>'tienvanbui1982001@gmail.com',
        ]);
    }
}
