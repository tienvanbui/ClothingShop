<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'coupon_code' => 'GGPT',
            'coupon_condition' => 1,
            'coupon_use_number' => 100,
            'coupon_price_discount' => 10,
        ]);
        Coupon::create([
            'coupon_code' => 'GGPTB',
            'coupon_condition' => 1,
            'coupon_use_number' => 50,
            'coupon_price_discount' => 20,
        ]);
        Coupon::create([
            'coupon_code' => 'GGPTC',
            'coupon_condition' => 1,
            'coupon_use_number' => 10,
            'coupon_price_discount' => 50,
        ]);
        Coupon::create([
            'coupon_code' => 'GGTMB',
            'coupon_condition' => 0,
            'coupon_use_number' => 5,
            'coupon_price_discount' => 100,
        ]);
        Coupon::create([
            'coupon_code' => 'GGTM',
            'coupon_condition' => 0,
            'coupon_use_number' => 40,
            'coupon_price_discount' => 10,
        ]);
    }
}
