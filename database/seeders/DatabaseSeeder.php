<?php

namespace Database\Seeders;

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
        $this->call(CartTableSeeder::class);
        $this->call(CartItemTableSeeder::class);
        $this->call(ColorTableSeeder::class);
        $this->call(OrderItemTableSeeder::class);
        $this->call(OrderTableTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ProductGroupTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
        $this->call(ReviewProductTableSeeder::class);
        $this->call(SizeTableSeeder::class);
        $this->call(VoiceTableSeeder::class);
        $this->call(VoiceProductTableSeeder::class);
    }
}
