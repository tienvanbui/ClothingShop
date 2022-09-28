<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'payment_method' => 'Cash Payment',
            'slug'=>'Cash'
        ]);
        Payment::create([
            'payment_method' => 'Card Payment',
            'slug'=>'Card'
        ]);
    }
}
