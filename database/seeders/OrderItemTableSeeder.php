<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderItemTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_item')->delete();
        
        
        
    }
}