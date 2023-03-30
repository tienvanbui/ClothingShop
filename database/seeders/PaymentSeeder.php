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
            'payment_method' => 'Trả tiền mặt',
            'slug'=>'Cash'
        ]);
        Payment::create([
            'payment_method' => 'Thẻ ngân hàng',
            'slug'=>'Card'
        ]);
    }
}
