<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ContactSeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            MenuSeeder::class,
            CouponSeeder::class,
            PaymentSeeder::class,
            TagSeeder::class
        ]);
    }
}
